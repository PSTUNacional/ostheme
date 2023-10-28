<?php
/*========================================

    PAGE RENDER

========================================*/

function render_theme_audio()
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

        .global-rate .dashicons{
            margin: 0;
        }

        .global-rate{
            display:flex;
            flex-direction:column;
            gap:8px
        }
    </style>
    <h1>Ombudsman</h1>
    <?php settings_errors(); // Exibe alertas na página 
    ?>
    <div style="display: flex; gap:24px">
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
        <div class="card" style="margin-top:0">
            <h3 id="post-title">Selecione uma matéria</h3>
            <div></div>
            <div style="display:flex; flex-direction:column;gap:24px">
                <div id="comments" style="display:flex; flex-direction:column;gap:8px">

                </div>
                <div>
                </div>
            </div>

            <script>
                fetch('https://www.opiniaosocialista.com.br/automation/src/Controller/Content.php?method=getByType&type=audio')
                    .then(resp => resp.json())
                    .then(data => {
                        data.forEach(result => {
                            console.log(results)
                            tr = '<tr"><td>' + result['post_title'] + '</td><td><a href="https://www.opiniaosocialista.com.br/archive/audio/'+result['filename']+'" download><span class="dashicons dashicons-media-audio"></span></a></td></tr>'

                            document.querySelector('table tbody').innerHTML += tr
                        })
                    })

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
                                switch (comment['rate']){
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
            </script>
        <?php
    }
