<?php
/*========================================

    PAGE RENDER

========================================*/

function render_theme_audio()
{
    $options = $GLOBALS['options'];
?>
    <link rel="stylesheet" href="../wp-content/themes/ostheme/assets/css/buttons.css">
    <link rel="stylesheet" href="../wp-content/themes/ostheme/assets/css/colors.css">
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

        .admin-table .dashicons {
            font-size: 16px;
            margin: 0 6px;
            color: #999;
            line-height: 1.25rem;
        }

        .search {
            position: relative;
        }

        input:focus+.search-result,
        .search .search-result:hover {
            display: flex;
        }

        .search .search-result {
            display: none;
            flex-direction: column;
            gap: 4px;
            position: absolute;
            border: 1px solid #999;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 6px 0 #0006;
            bottom: 0;
            transform: translateY(100%);
            width: 100%;
            box-sizing: border-box;
            overflow-y: scroll;
            max-height: 320px;
        }

        .result {
            cursor: pointer;
            padding: 4px 12px
        }

        .result:hover {
            background-color: #fee;
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
            <form id="audioform">
                <div class="line search">
                    <label for="post">Matéria</label>
                    <input type="text" name="title" id="" />
                    <div class="search-result">
                        <p>Procurando resultados...</p>
                    </div>
                </div>
                <input type="file" name="audiofile" id="" accept=".mp3,.wav,.flac,.ogg">
                <div class="line">
                    <label for="author">Locutor</label>
                    <input type="text" name="author" id="" />
                </div>
                <div class="line">
                    <label for="tags">Tags</label>
                    <input type="text" name="tags" id="" />
                    <p>Identifique o coteúdo separando as tags por vírgula. Por exemplo: <b>Editorial, OS633</b>.
                </div>
                <input style="display:none" type="text" name="id" id="" />
                <input style="display:none" type="text" name="url" id="" />
                <div class="line">
                    <button onclick="validate()" class="btn primary" value="Postar">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('.search input').addEventListener('input', (event) => {
            p = document.querySelector('.search-result')

            s = event.target.value.toLowerCase()
            s.toLowerCase()
            if (s.length > 3) {
                p.innerHTML = '';
                fetch('https://www.opiniaosocialista.com.br/wp-json/wp/v2/search?_embed&search=' + s)
                    .then(resp => resp.json())
                    .then(results => {
                        results.forEach((r) => {
                            item = '<div class="result" onclick="setPost(' + r['id'] + ',\'' + r['url'] + '\')">' + r['title'] + '</div>'
                            p.innerHTML += item
                        })
                    })
            }
        })

        function setPost(id, url) {
            form = document.getElementById('audioform');
            form.title.value = event.target.innerText
            form.id.value = id
            form.url.value = url
        }

        fetch('https://www.opiniaosocialista.com.br/automation/src/Controller/Content.php?method=getByType&type=audio&limit=30')
            .then(resp => resp.json())
            .then(data => {
                data.forEach(result => {
                    tr = '<tr"><td>' + result['post_title'] + '</td><td><a href="https://www.opiniaosocialista.com.br/archive/audio/' + result['filename'] + '" download><span class="dashicons dashicons-media-audio"></span></a></td></tr>'

                    document.querySelector('table tbody').innerHTML += tr
                })
            })



        function validate() {
            event.preventDefault()
            form = document.getElementById('audioform');
            if (form.title.value == '') {
                window.alert('É preciso inserir uma matéria.')
                return false
            }
            if (form.audiofile.files.length !== 1) {
                window.alert('É preciso inserir um arquivo.')
                return false
            }
            if (form.author.value == '') {
                window.alert('É preciso inserir um autor.')
                return false
            }

            data = new FormData();

            data.append('id', form.id.value)
            data.append('url', form.url.value)
            data.append('title', form.title.value)
            data.append('author', form.author.value)
            data.append('tags', form.tags.value)
            data.append('file', form.audiofile.files[0])

            fetch("https://www.opiniaosocialista.com.br/automation/src/Controller/Content.php?method=createAudio", {
                method: "POST",
                body: data,
            })
        }
    </script>
<?php
}
