// Cada desafio: título, enunciado, código inicial e testes [descrição, expressão]
const desafios = [
  { titulo: "Olá, mundo", enunciado: "Use console.log para mostrar exatamente: Olá, mundo!",
    inicial: "// escreva seu código aqui\n",
    testes: [["Exibe \"Olá, mundo!\"", "__logs.join('\\n').includes('Olá, mundo!')"]] },
  { titulo: "Somar dois números", enunciado: "Crie a função soma(a, b) que retorna a soma dos dois valores.",
    inicial: "function soma(a, b) {\n  \n}\n",
    testes: [["soma(2, 3) retorna 5", "soma(2,3)===5"], ["soma(-1, 1) retorna 0", "soma(-1,1)===0"]] },
  { titulo: "Par ou ímpar", enunciado: "Crie parOuImpar(n) que retorna \"par\" ou \"impar\".",
    inicial: "function parOuImpar(n) {\n  \n}\n",
    testes: [["4 é par", "parOuImpar(4)==='par'"], ["7 é impar", "parOuImpar(7)==='impar'"]] },
  { titulo: "FizzBuzz", enunciado: "Crie fizzbuzz(n): \"Fizz\" se n é múltiplo de 3, \"Buzz\" se de 5, \"FizzBuzz\" se de ambos; senão retorna o próprio número.",
    inicial: "function fizzbuzz(n) {\n  \n}\n",
    testes: [["3 → Fizz", "fizzbuzz(3)==='Fizz'"], ["5 → Buzz", "fizzbuzz(5)==='Buzz'"],
             ["15 → FizzBuzz", "fizzbuzz(15)==='FizzBuzz'"], ["7 → 7", "fizzbuzz(7)===7"]] }
];

const $ = id => document.getElementById(id);
const lista = $("lista"), codigo = $("codigo"), saida = $("saida");
let atual = 0;
let feitos = [];
try { feitos = JSON.parse(localStorage.getItem("cq_feitos") || "[]"); } catch (e) {}

function esc(t) { const d = document.createElement("div"); d.textContent = t; return d.innerHTML; }

function desenharLista() {
  lista.innerHTML = "";
  desafios.forEach((d, i) => {
    const b = document.createElement("button");
    b.type = "button";
    b.textContent = d.titulo;
    b.setAttribute("aria-current", i === atual);
    if (feitos.includes(i)) b.className = "feito";
    b.onclick = () => abrir(i);
    lista.appendChild(b);
  });
  $("progresso").style.width = (feitos.length / desafios.length * 100) + "%";
  $("progresso-texto").textContent = feitos.length + " de " + desafios.length + " desafios concluídos";
}

function abrir(i) {
  atual = i;
  $("titulo-desafio").textContent = desafios[i].titulo;
  $("enunciado").textContent = desafios[i].enunciado;
  codigo.value = localStorage.getItem("cq_codigo_" + i) || desafios[i].inicial;
  saida.innerHTML = '<span class="vazio">Clique em Executar para ver o resultado.</span>';
  desenharLista();
}

function executar() {
  const d = desafios[atual];
  localStorage.setItem("cq_codigo_" + atual, codigo.value);
  const token = String(Math.random());
  const seguro = s => s.replace(/<\/script/gi, "<\\/script");

  // O código roda dentro de um iframe isolado (sandbox), sem acesso à página.
  const html = `<script>
    const __logs=[]; const __t=${JSON.stringify(token)};
    const __send=(tipo,msg)=>parent.postMessage({__t,tipo,msg},"*");
    ["log","warn","error"].forEach(k=>console[k]=(...a)=>{
      const s=a.map(x=>typeof x==="object"?JSON.stringify(x):String(x)).join(" ");
      __logs.push(s); __send(k==="log"?"log":"erro",s);});
    onerror=(m)=>{__send("erro",String(m));return true};
  <\/script>
  <script>${seguro(codigo.value)}\n<\/script>
  <script>
    ${JSON.stringify(d.testes)}.forEach(([nome,expr])=>{
      let ok=false; try{ok=!!eval(expr)}catch(e){}
      __send("teste",JSON.stringify([nome,ok]));
    }); __send("fim","");
  <\/script>`;

  saida.textContent = "";
  const resultados = [];
  const antigo = $("sandbox"); if (antigo) antigo.remove();
  const frame = document.createElement("iframe");
  frame.id = "sandbox";
  frame.hidden = true;
  frame.setAttribute("sandbox", "allow-scripts");

  const ouvir = e => {
    if (e.source !== frame.contentWindow || !e.data || e.data.__t !== token) return;
    const { tipo, msg } = e.data;
    if (tipo === "log") saida.innerHTML += esc(msg) + "\n";
    else if (tipo === "erro") saida.innerHTML += '<span class="erro">Erro: ' + esc(msg) + "</span>\n";
    else if (tipo === "teste") resultados.push(JSON.parse(msg));
    else if (tipo === "fim") {
      window.removeEventListener("message", ouvir);
      saida.innerHTML += "\n";
      resultados.forEach(([n, ok]) =>
        saida.innerHTML += `<span class="${ok ? "ok" : "erro"}">${ok ? "✓" : "✗"} ${esc(n)}</span>\n`);
      if (resultados.every(r => r[1])) {
        saida.innerHTML += '\n<span class="ok">Desafio concluído! 🎉</span>';
        if (!feitos.includes(atual)) {
          feitos.push(atual);
          localStorage.setItem("cq_feitos", JSON.stringify(feitos));
          desenharLista();
        }
      }
    }
  };
  window.addEventListener("message", ouvir);
  frame.srcdoc = html;
  document.body.appendChild(frame);
}

$("executar").onclick = executar;
$("resetar").onclick = () => { localStorage.removeItem("cq_codigo_" + atual); abrir(atual); };
codigo.addEventListener("keydown", e => {
  if (e.key === "Tab") {
    e.preventDefault();
    codigo.setRangeText("  ", codigo.selectionStart, codigo.selectionEnd, "end");
  }
  if (e.key === "Enter" && (e.ctrlKey || e.metaKey)) { e.preventDefault(); executar(); }
});
abrir(0);
