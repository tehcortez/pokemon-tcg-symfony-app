$(document).ready(function() {
    let currentPage = localStorage.getItem('currentPage') ? localStorage.getItem('currentPage') : 1;
    $('#page-info').text(`Page ${currentPage}`);
    $('#page-input').val(currentPage);
    let lastPage = currentPage+1;

    $('#fetch-button').click(function() {
        currentPage = $('#page-input').val();
        fetchPokemonCards(currentPage);
    });

    $('#prev-button').click(function() {
        if (currentPage > 1) {
            currentPage--;
            fetchPokemonCards(currentPage);
        }
    });

    $('#next-button').click(function() {
        // currentPage++;
        // fetchPokemonCards(currentPage);
        if (currentPage < lastPage) {
            currentPage++;
            fetchPokemonCards(currentPage);
        }
    });

    function fetchPokemonCards(page) {
        localStorage.setItem('currentPage',currentPage);
        $("#next-button").attr("disabled", true);
        $("#prev-button").attr("disabled", true);
        $("#fetch-button").attr("disabled", true);
        $.ajax({
            url: '/api/pokemon-cards',
            method: 'GET',
            data: { page: page },
            success: function(response) {
                lastPage = response.meta.totalPages;
                displayPokemonCards(response.data);
                updatePagination(page);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.error);
            }
        });
    }

    function displayPokemonCards(cards) {
        const container = $('#pokemon-cards-container');
        container.empty();

        if (cards.length === 0) {
            container.append('<p>No Pokémon cards found.</p>');
        } else {
            cards.forEach(function(card) {
                container.append(`
                            <li>
                                <a href="/card/${card.id}">
                                    <div class="zoom">
                                        <img class="pokemonImageSmall" src="${card.images.small}" alt="${card.name}" data-id="${card.id}">
                                        <p>Name: ${card.name}</p>
                                        <p>ID: ${card.id}</p>
                                        <p>Type(s): ${card.types.join(', ')}</p>
                                    </div>
                                </a>
                            </li>
                        `);
            });
        }
    }

    function updatePagination(page) {
        $('#page-info').text(`Page ${page}`);
        $("#prev-button").attr("disabled", page <= 1);
        // $('#prev-button').prop('disabled', page <= 1);
        $("#next-button").attr("disabled", page >= lastPage);
        // $('#next-button').prop('disabled', page >= lastPage);
        $('#page-input').val(page);
        $('#page-input').attr({
            "max" : lastPage,
            "min" : 1
        });
        $("#fetch-button").attr("disabled", false);
    }

    // Initial fetch for page 1
    fetchPokemonCards(currentPage);
});