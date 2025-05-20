<?php

/*
Template Name: Efemérides
*/

get_header(); ?>

<div class="content-area">
    <style>
        h1 {
            text-align: center;
            margin: 48px auto;
        }

        tbody h4 {
            font-size: 1.15em;
        }

        tbody tr td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }

        td.main {
            text-align: left;
            border-left: 4px solid #fff;
        }

        tbody tr:hover td{
            background-color: #c001;

        }tbody tr:hover td.main{
            border-left: 4px solid #c00;
        }

        td.main span {
            color: #999;
            font-size: 0.8em;
        }

        span.badge{
            font-size: 0.8em;
            color: #fff;
            font-weight: bolder;
            padding:4px 12px;
            border-radius: 24px;
            width: fit-content;
        }

        span.badge.alert{
            background-color: #c00;
        }
        span.badge.week{
            background-color: #0c0;
        }
        span.badge.month{
            background-color: #999;
        }
    </style>
    <main>

        <div class="container" style="display:flex;flex-gap:24px; flex-direction:column">
            <h1>Efemérides</h1>
            <table>
                <thead>
                    <tr>
                        <th>Eventos</th>
                        <th>Tipo</th>
                        <th>Anos</th>
                        <th>Data</th>
                        <th>Ocorrem em</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </main>
    <script>
        const months = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez']

        async function getContent() {
            await fetch('../automation/banners/src/Controller/Event.php?method=getAll')
                .then(resp => resp.json())
                .then(data => {

                    data.forEach(event => {

                        if (event['daysto'] <= 30 && event['daysto'] > 7){
                            alert = '<span class="badge month">30 dias</span>';
                        } else if (event['daysto'] <= 7 && event['daysto'] > 0){
                            alert = '<span class="badge week">Essa semana</span>';
                        }else if(event['daysto'] == 0){
                            alert = '<span class="badge alert">HOJE</span>';
                        } else {
                            alert = ''
                        }

                        desc = event['description'] ==
                            null ? '' : event['description']

                        if(event['type'] !== 'Efeméride'){
                            years = event['years'] 
                        } else {
                            years = '-'
                        }

                        l = '<tr><td class="main"><h4>' + event['name'] + '</h4><span>' + desc + '</span></td><td>'+event['type']+'</td><td>'+years+'</td><td>' + event['date'] + '</td><td>' + event['daysto'] + ' dias</td><td>'+alert+'</td></tr>'

                        document.querySelector('tbody').innerHTML += l
                    })
                })


        }

        window.addEventListener('load', function() {
            getContent()
        })
    </script>
</div>
<?php get_footer(); ?>