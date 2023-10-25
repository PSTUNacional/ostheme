function openMobileMenu() {
    document.querySelector('.main-menu').classList.toggle('active');
    document.querySelector('.backdrop').classList.toggle('active');
}

function renderEvaluationScale(id) {

    place = document.querySelector('article div.container')
    evaluationBox = document.createElement('div');
    evaluationBox.className = "evaluation-box";
    evaluationBox.innerHTML = `<div class="line"><h3>O que achou dessa matéria?</h3>
            <div class="star-list">
                <label>
                    <input type="radio" name="rank" value="1"></input>
                    <i class="material-icons not-checked">star_outline</i>
                    <i class="material-icons checked">star</i>
                </label>
                <label>
                    <input type="radio" name="rank" value="2"></input>
                    <i class="material-icons not-checked">star_outline</i>
                    <i class="material-icons checked">star</i>
                </label>
                <label>
                    <input type="radio" name="rank" value="3"></input>
                    <i class="material-icons not-checked">star_outline</i>
                    <i class="material-icons checked">star</i>
                </label>
                <label>
                    <input type="radio" name="rank" value="4"></input>
                    <i class="material-icons not-checked">star_outline</i>
                    <i class="material-icons checked">star</i>
                </label>
                <label>
                    <input type="radio" name="rank" value="5"></input>
                    <i class="material-icons not-checked">star_outline</i>
                    <i class="material-icons checked">star</i>
                </label>
            </div>
            </div>
            <div class="comment-container">
                <p>Quer deixar um comentário?</p>
                <textarea rows="8"></textarea>
                <button class="btn primary" onclick="submitEvaluation()">Enviar</button>
                </div>
                <input name="contentid" value="${id}" style="display:none"/>`

    place.append(evaluationBox)


    setTimeout(() => {
        document.querySelectorAll('.star-list input').forEach(el => {
            el.addEventListener('click', countStars)
        })
    }, 100)
}

function countStars() {
    input = event.currentTarget;
    total = input.value;
    parent = input.parentElement.parentElement;
    starlist = parent.querySelectorAll('label')
    node = parent.parentElement.parentElement;

    if (input.checked == true) {
        starlist.forEach(star => {
            star.classList.remove('active')
        })
        for (i = 0; i < total; i++) {
            starlist[i].classList.add('active')
        }
    }

    node.querySelector('.comment-container').style.display = "flex";

}

function submitEvaluation() {
    box = event.currentTarget.parentElement.parentElement;
    form = new FormData();

    rank = box.querySelector('input:checked').value;
    id = box.querySelector('input[name="contentid"]').value;
    comment = box.querySelector('textarea').value;

    form.append('rank', rank)
    form.append('id', id)
    form.append('comment', comment)

    box.innerHTML = "<h3>Obrigado pelo sua avaliação!</h3><p>Sua contribuição é importante para melhoria do nosso trabalho.</p>"

    fetch("/wp-content/themes/ostheme/src/Controller/Evaluations.php?method=insert", {
        method: "POST",
        body: form,
    })

    box.innerHTML = "<h4 style='margin:0'>Obrigado pelo sua avaliação!</h4><p>Sua contribuição é importante para melhoria do nosso trabalho.</p>"
}

// Adds chevron icon to Nav menu
menuitems = document.querySelectorAll('.sub-menu')
menuitems.forEach((s) => { s.parentElement.querySelector('a').innerHTML += '<i class="fa fa-caret-right"></i>' })

/*========================================

    SEARCH BAR

*========================================*/

function handleSearchBar() {
    s = document.getElementById('search-bar');
    c = s.querySelector('.container')
    ch = c.offsetHeight

    if (s.offsetHeight == 0) {
        s.style.height = ch + 'px'
    } else {
        s.style.height = '0px'
    }
}

document.querySelector('#search-bar input[type=text]')
    .addEventListener('keyup', async () => {
        sq = event.target.value
        if (sq.length > 3) {
            await fetch('https://www.opiniaosocialista.com.br/wp-json/wp/v2/search?_embed&search=' + sq)
                .then(resp => resp.json())
                .then(results => {

                    place = document.querySelector('#search-bar .fast-results');
                    place.innerHTML = '';


                    if (results.length >= 1) {
                        document.getElementById('fast-results-header').style.display = "block"
                        for (i = 0; i < 3; i++) {

                            title = results[i]['title']
                            fimg = results[i]['_embedded']['self'][0]['fimg_url']
                            console.log(fimg)
                            link = results[i]['url']
                            category = results[i]['categories_names'][0]

                            article = document.createElement('article')
                            article.innerHTML = '<a class="featured-image-container" href="' + link + '"><div class="featured-image" style="background-image:url(' + fimg + ')"></div></a><div class="info"><span class="sup-category">' + category + '</span><a href=' + link + '><h3>' + title + '</h3></a>'
                            place.prepend(article)
                        }
                    } else {
                        document.getElementById('fast-results-header').style.display = "none"
                        place.innerHTML = '<p style="width:100%;text-align:center">Não encontramos nada =/</p>';
                    }
                    s = document.getElementById('search-bar');
                    c = s.querySelector('.container')
                    ch = c.offsetHeight
                    s.style.height = ch + 'px'
                })
        }

    })