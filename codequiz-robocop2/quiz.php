<?php
$titulo = 'Quiz de linguagens';
$pagina = 'quiz';
$linguagens = require 'data/quiz-data.php';
include 'includes/header.php';
?>
<main class="qz">
    <section id="menu">
        <h1>Escolha sua linguagem</h1>
        <p class="sub">4 perguntas por rodada, 20 segundos cada. Use as teclas 1–4 ou A–D para responder. Sequências e rapidez valem mais XP.</p>
        <div class="langs">
        <?php foreach ($linguagens as $id => $l): ?>
            <button class="lang" style="--c:<?= $l[1] ?>" data-id="<?= $id ?>">
                <span class="tag">&lt;<?= $l[0] ?>/&gt;</span><h3><?= $l[0] ?></h3><small><?= $l[2] ?> · <?= count($l[3]) ?> perguntas</small>
            </button>
        <?php endforeach; ?>
        </div>
    </section>

    <section id="jogo" class="hidden">
        <div class="hud">
            <button class="back" id="sair">← Trocar linguagem</button>
            <div class="bar"><i id="prog"></i></div>
            <span class="pill" id="num"></span><span class="pill" id="tempo">⏱ 20s</span><span class="pill">🔥 <span id="seq">0</span></span><span class="pill">⭐ <span id="xp">0</span> XP</span>
        </div>
        <div class="box" id="card" aria-live="polite">
            <h2 id="perg"></h2><div class="code hidden" id="cod"></div>
            <div class="opts" id="ops"></div>
            <div class="fb" id="fb"></div>
            <button class="btn btn-p next" id="prox">Próxima</button>
        </div>
    </section>

    <section id="fim" class="hidden">
        <div class="box res">
            <div class="medal" id="medal"></div><div class="big" id="pct"></div>
            <h2 id="msg"></h2><p id="det"></p><p id="salvo" class="salvo"></p>
            <div class="acts" style="justify-content:center"><button class="btn btn-p" id="de-novo">Jogar de novo</button><button class="btn btn-o" id="outra">Outra linguagem</button></div>
        </div>
    </section>
</main>
<script>window.QUIZ_LOGADO = <?= $usuario ? 'true' : 'false' ?>; window.QUIZ_CSRF = <?= json_encode(csrf_token()) ?>;
window.QUIZ_DADOS = <?= json_encode($linguagens, JSON_UNESCAPED_UNICODE) ?>;</script>
<script src="js/quiz.js"></script>
<?php include 'includes/footer.php'; ?>
