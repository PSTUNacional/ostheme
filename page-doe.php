<?php

/*
Template Name: Doe
*/

get_header(); ?>
<link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/doe.css' ?>" />
<div class="content-area">
    <div id="backdrop">
        <div class="pix-modal">
            <h3>Muito obrigado!</h3>
            <p>Agora é só fazer a leitura do QR Code com o aplicativo do seu banco</p>
            <div class="image"></div>
            <div>
                <p>Você também pode copiar o código do pagamento:</p>
                <div style="display:flex;gap:16px;">
                    <input type="text" style="margin:0; width: 100%" id="qrcode-number">
                    <button class="btn primary" onclick="copyQRCode()">Copiar</button>
                </div>
                <button class="btn secondary" style="margin-top:24px; width:100%; max-width:inherit" onclick="closeModal()">Fechar</button>
            </div>
        </div>
    </div>
    <main>
        <section>
            <div class="container">
                <div class="col va-center">
                    <h1><span>Contribua com o</span>Opinião Socialista</h1>
                    <h3>E ajude a fortalecer a imprensa socialista e independente.</h3>
                    <p>Tudo o que fazemos é fruto do esforço de militantes comprometidos com um programa socialista e revolucionário para o Brasil e para o mundo. Mas para manter uma imprensa ativa, publicando e elaborando diaramente sobre a realidade brasileira, existem custos que não são possíveis contornar.</p>
                    <p>Além disso, ao contribuir com o <b>Opinião Socialista</b> você nos ajuda a manter a independência de classe. Não aceitamos dinheiro de banqueiros e empresários. Tudo aqui é fruto do esforço de trabalhadoras e trabalhadores que dedicam suas horas livres para a construção desse projeto.</p>
                </div>
                <div class="col">
                    <form id="form_data" onsubmit="validatePixForm()">
                        <div class="line">
                            <label for="fname">Nome completo</label>
                            <input type="text" name="fname" required />
                            <span class="alert"></span>
                        </div>
                        <div class="line">
                            <label for="fcpf">CPF</label>
                            <input name="fcpf" class="cpf" required />
                            <span class="alert"></span>
                        </div>
                        <div class="line">
                            <label for="fphone">Telefone com DDD</label>
                            <input name="fphone" class="phone" required />
                            <span class="alert"></span>
                        </div>
                        <div class="line">
                            <label for="faddress">Endereço</label>
                            <input name="faddress" required />
                            <span class="alert"></span>
                        </div>

                        <fieldset>
                            <legend>Valor</legend>
                            <div class="pill-container">
                                <label for="psv10">
                                    <input type="radio" name="fpsv" id="psv10" value="10">
                                    <span>R$10</span>
                                </label>
                                <label for="psv25">
                                    <input type="radio" name="fpsv" id="psv25" value="25" checked>
                                    <span>R$25</span>
                                </label>
                                <label for="psv50">
                                    <input type="radio" name="fpsv" id="psv50" value="50">
                                    <span>R$50</span>
                                </label>
                                <label for="psv100">
                                    <input type="radio" name="fpsv" id="psv100" value="100">
                                    <span>R$100</span>
                                </label>
                                <label for="psv200">
                                    <input type="radio" name="fpsv" id="psv200" value="200">
                                    <span>R$200</span>
                                </label>
                                <label for="psvManual">
                                    <input type="radio" name="fpsv" id="psvManual" value="0">
                                    <span>Outro valor</span>
                                </label>
                            </div>
                        </fieldset>

                        <div class="custom-value" style="display:none">
                            <div class="line">
                                <label for="fvalue">Valor</label>
                                <input class="money2" name="fvalue" required value="R$25,00" style="width:100%"/>
                                <span class="alert"></span>
                            </div>
                        </div>
                        <input type="submit" id="submit_btn" class="btn primary" style="width:100%" value="Fazer a doação" />
                        <div class="infobox">
                            <h3><i class="fa fa-info-circle"></i> Por que preciso fornecer essas informações?</h3>
                            <p>Por exigências legais, precisamos dessas informações para prestação de contas.</p>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </main>
</div>
<script src="<?= get_template_directory_uri() . '/assets/js/doe.js' ?>"></script>
<script>
    window.onload = document.querySelector('.footer-popup').remove()
</script>
<?php get_footer(); ?>