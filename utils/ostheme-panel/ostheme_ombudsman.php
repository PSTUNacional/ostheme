<?php
/*========================================

    PAGE RENDER

========================================*/

function render_theme_ombudsman()
{
    $options = $GLOBALS['options'];
?>
    <link rel="stylesheet" href="./style.css">
    <h1>Ombudsman</h1>
    <?php settings_errors(); // Exibe alertas na página 
    ?>
    <table class="admin-table">
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

    <script>
        fetch('/wp-content/themes/ostheme/src/Controller/Evaluations.php?method=getAllEvaluations')
        .then(resp=>resp.json() )
        .then(data=>{
            data.forEach(result =>{
                tr = '<tr><td>'+result['title']+'</td><td><span class="dashicons dashicons-star-filled"></span>'+result['rate']+' ('+result['evaluations']+')</td><td><span class="dashicons dashicons-admin-comments"></span>'+result['comments']+'</td></tr>'

                document.querySelector('table tbody').innerHTML += tr
            })

            
        })
    </script>
<?php
}
