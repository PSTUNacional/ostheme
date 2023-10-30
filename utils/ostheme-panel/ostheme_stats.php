<?php
/*========================================

    PAGE RENDER

========================================*/

function render_theme_stats()
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

        .card {
            position: relative;
        }

        #load {
            position: absolute;
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            background-color: #0005;
            backdrop-filter: blur(5px);
            z-index: 99;
            top: 0;
            left: 0;
        }
    </style>
    <h1>Estatísticas do Portal</h1>
    <?php settings_errors(); // Exibe alertas na página 
    ?>

    <iframe width="1080" height="1600" src="https://lookerstudio.google.com/embed/reporting/4913cf9a-a68a-468a-b2ff-93c9b6c63e72/page/wrqgD" frameborder="0" style="border:0" allowfullscreen></iframe>

    <script>
        getAudioList()

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


        function getAudioList() {
            p = document.querySelector('table tbody');
            p.innerHTML = ''
            fetch('https://www.opiniaosocialista.com.br/automation/src/Controller/Content.php?method=getByType&type=audio&limit=30')
                .then(resp => resp.json())
                .then(data => {
                    data.forEach(result => {
                        tr = '<tr"><td>' + result['post_title'] + '</td><td><a href="https://www.opiniaosocialista.com.br/archive/audio/' + result['filename'] + '" download><span class="dashicons dashicons-media-audio"></span></a></td></tr>'

                        p.innerHTML += tr
                    })
                })
        }

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

            load = document.getElementById('load').style.display = "flex"

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
                .then(response => {
                    getAudioList()
                    form.reset()
                    load = document.getElementById('load').style.display = "none"
                })
        }
    </script>
<?php
}
