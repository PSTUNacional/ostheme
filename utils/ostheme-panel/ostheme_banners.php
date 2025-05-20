<?php
/*========================================

    PAGE RENDER

========================================*/

function render_banners_admin()
{
    $options = $GLOBALS['options'];
?>
    <link rel="stylesheet" href="../wp-content/themes/ostheme/assets/css/buttons.css">
    <link rel="stylesheet" href="../wp-content/themes/ostheme/assets/css/colors.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css " rel="stylesheet">
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

        tbody i.material-icons {
            color: #ccc;
            cursor: pointer
        }

        tbody i.material-icons:hover {
            color: #c00;
        }

        tbody i.active {
            display: inherit;
        }

        tbody i.inactive {
            display: none;
        }

        .swal2-popup {
            line-height: 1.25;
        }
    </style>
    <h1>Gerenciamento de Banners</h1>
    <?php settings_errors(); // Exibe alertas na página 
    ?>
    <div style="display: flex; gap:24px">
        <table class="wp-list-table widefat striped admin-table">
            <thead>
                <tr>
                    <th colspan="2">Matéria</th>

                    <th>Formatos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        async function getContent() {
            await fetch('/automation/banners/src/Controller/Content.php?method=getAllContent')
                .then(resp => resp.json())
                .then(data => {

                    table = document.querySelector('table tbody')

                    data.forEach(c => {

                        bannerIcon = c.banner_file ? 'active' : 'inactive'
                        storyIcon = c.story_file ? 'active' : 'inactive'
                        title = c.link.split('/')[3]

                        tr = '<tr"><td>' + c.contentid + '</td><td><a href="' + c.link + '" target="_blank">' + title + '</a></td><td><a href="' + c.banner_path + '" target="_blank"><i class="material-icons ' + bannerIcon + '">crop_original</i></a><a href="' + c.story_path + '" target="_blank"><i class="material-icons ' + storyIcon + '">crop_portrait</i></a></td><td><a onclick="confirmRestore(' + c.contentid + ')" title="Regenerar conteúdo"><i class="material-icons">restore</i></a></td></tr>'
                        table.innerHTML += tr
                    })
                })
        }
        getContent();

        function confirmRestore(id) {
            Swal.fire({
                title: "Tem certeza que deseja força a restauração desses banners?",
                showCancelButton: true,
                confirmButtonText: "Sim, restaurar",
                confirmButtonColor: "#c00",

            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Restaurando os materiais...",
                        html: '<span></span>',
                        didOpen: async () => {
                            Swal.showLoading()
                            place = Swal.getPopup().querySelector("span")
                            place.textContent = "Apgando arquivos e regristros..."
                            await deleteContent(id)
                            place.textContent = "Recriando novos arquivos. Isso vai levar alguns segundos."
                            result = await createBanner(id)
                            Swal.fire({
                                title: "Tudo feito!",
                                text: "Os banners foram recriados com sucesso!",
                                icon: "success",
                                confirmButtonColor: "#c00",
                            }).then((result)=>{
                                location.reload();
                            });
                        }
                    })
                }
            });
        }

        async function deleteContent(id) {
            return await fetch('/automation/banners/src/Controller/Content.php?method=deleteContent&contentid=' + id).then(resp => resp.json())
        }

        async function createBanner(id) {
            return await fetch('/automation/banners/src/Controller/Content.php?method=createBanner&contentid=' + id).then(resp => resp.json())
        }
    </script>
<?php
}
