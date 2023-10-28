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
        form {
            display: flex;
            flex-direction: column;
            gap: 24px;
            width: 100%;
            padding-bottom: 24px;
        }

        form input {
            width: 100%;
        }

        form div.line {
            display: flex;
            gap: 4px;
            flex-direction: column;
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
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="card" style="margin-top:0">
            <h3 id="post-title">Adicionar um áudio</h3>
            <form>
                <div class="line">
                    <label for="post">Matéria</label>
                    <input type="text" name="post" id="" />
                </div>
                <input type="file" name="file" id="" accept=".mp3,.wav,.flac,.ogg">
                <div class="line">
                    <label for="authorName">Locutor</label>
                    <input type="text" name="authorName" id="" />
                </div>
                <div class="line">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" id="" />
                </div>
                <div class="line">
                    <input class="btn primary" type="submit" value="Postar" />
                </div>
            </form>
        </div>
    </div>

    <script>
        fetch('https://www.opiniaosocialista.com.br/automation/src/Controller/Content.php?method=getByType&type=audio&offset=30')
            .then(resp => resp.json())
            .then(data => {
                data.forEach(result => {
                    tr = '<tr"><td>' + result['post_title'] + '</td><td><a href="https://www.opiniaosocialista.com.br/archive/audio/' + result['filename'] + '" download><span class="dashicons dashicons-media-audio"></span></a></td></tr>'

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
    </script>
<?php
}
