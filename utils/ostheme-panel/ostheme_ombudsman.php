<?php
/*========================================

    PAGE RENDER

========================================*/

function render_theme_ombudsman()
{
    $options = $GLOBALS['options'];
?>
    <link rel="stylesheet" href="./style.css">
    <style>
        .comment-card {
            display: flex;
            gap: 8px;
            flex-direction: column;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .global-rate .dashicons,
        .comment-card .stars .dashicons {
            font-size: 12px;
            color: #999;
        }

        .global-rate .dashicons {
            margin: 0;
        }

        .global-rate {
            display: flex;
            flex-direction: column;
            gap: 8px
        }
    </style>
    <h1>Ombudsman</h1>
    <?php settings_errors(); // Exibe alertas na página 
    ?>
    <div style="display: flex; gap:24px">
        <div style="display:flex; gap: 24px; flex-direction:column">
            <div style="display:flex; gap:24px;">
            <p>Filtrar por: </p>
            <select name="" id="orderBy" onchange="getResults()">
                <option value="" disabled selected>Ordenar por</option>
                <option value="content_id">Conteúdo mais recente</option>
                <option value="evaluations">Mais avaliações</option>
                <option value="comments">Mais comentários</option>
            </select>   
            <p>Resultados por página: </p>
            <select name="" id="perPage" onchange="getResults()">
                <option value="" disabled selected>Resultados por página</option>
                <option value="15">15</option>
                <option value="30">30</option>
                <option value="60">60</option>
            </select>    
        </div>
            <table class="wp-list-table widefat striped admin-table">
                <thead>
                    <tr>
                        <th>Matéria</th>
                        <th>Avaliação</th>
                        <th>Comentários</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="card" style="margin-top:0">
            <h3 id="post-title">Selecione uma matéria</h3>
            <div></div>
            <div style="display:flex; flex-direction:column;gap:24px">
                <div class="global-rate">
                    <div>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span id="ratefive">0</span>
                    </div>
                    <div>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span id="ratefour">0</span>
                    </div>
                    <div>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span id="ratethree">0</span>
                    </div>
                    <div>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span id="ratetwo">0</span>
                    </div>
                    <div>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span class="dashicons dashicons-star-empty"></span>
                        <span id="rateone">0</span>
                    </div>
                </div>
                <div id="comments" style="display:flex; flex-direction:column;gap:8px">

                </div>
                <div>
                </div>
            </div>

            <script>
                async function getResults(){

                urlBase = '/wp-content/themes/ostheme/src/Controller/Evaluations.php?method=getAllEvaluations'
                
                orderBy = document.getElementById('orderBy').value
                if (orderBy !== ''){
                    urlBase += '&order='+orderBy
                }

                resultsPerPage = document.getElementById('perPage').value
                if (resultsPerPage !== ''){
                    urlBase += '&limit='+resultsPerPage
                }

                document.querySelector('table tbody').innerHTML = ''
                fetch(urlBase)
                    .then(resp => resp.json())
                    .then(data => {
                        data.forEach(result => {
                            tr = '<tr onclick="getComments(' + result['content_id'] + ')"><td>' + result['title'] + '</td><td><span class="dashicons dashicons-star-filled"></span>' + result['rate'] + ' (' + result['evaluations'] + ')</td><td><span class="dashicons dashicons-admin-comments"></span>' + result['comments'] + '</td></tr>'

                            document.querySelector('table tbody').innerHTML += tr
                        })
                    })
                }

                async function getComments(id) {
                    await fetch('/wp-content/themes/ostheme/src/Controller/Evaluations.php?method=getAllComments&id=' + id)
                        .then(resp => resp.json())
                        .then(data => {
                            document.getElementById('post-title').innerText = data[0]['title']
                            document.getElementById('comments').innerHTML = ''

                            ratefive = 0
                            ratefour = 0
                            ratethree = 0
                            ratetwo = 0
                            rateone = 0

                            data.forEach(comment => {
                                switch (comment['rate']) {
                                    case '5':
                                        ratefive++
                                        break;
                                    case '4':
                                        ratefour++
                                        break;
                                    case '3':
                                        ratethree++
                                        break;
                                    case '2':
                                        ratetwo++
                                        break;
                                    case '1':
                                        rateone++
                                        break;
                                }
                                if (comment['comment'] !== '') {
                                    let stars = ''
                                    for (i = 0; i < comment['rate']; i++) {
                                        stars += '<span class="dashicons dashicons-star-filled"></span>'
                                    }

                                    tr = '<div class="comment-card"><div class="stars">' + stars + '</div>' + comment['comment'] + '<div>'
                                    document.getElementById('comments').innerHTML += tr
                                }

                                document.getElementById('ratefive').innerText = ratefive
                                document.getElementById('ratefour').innerText = ratefour
                                document.getElementById('ratethree').innerText = ratethree
                                document.getElementById('ratetwo').innerText = ratetwo
                                document.getElementById('rateone').innerText = rateone
                            })
                        })
                }

                getResults();
            </script>
        <?php
    }
