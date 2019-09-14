# teed-languages

Este é mais um experimento do que poderia ser feito quando o assunto é internacionalização de sites.
O sistema busca as linguagens preferidas do cliente através da variável `$_SERVER["HTTP_ACCEPT_LANGUAGE"]` do `PHP`.
Caso não encontre valores, ele usa a linguagem definida como default.

Não é a melhor forma de se fazer, mas é uma forma que encontrei.

Fork e adicione um pull-request ao projeto!

---

##### screenshots

*Mostrando linguagem default:*

![screenshot 1](prints/1.png)

*Selecionando linguagem inglês:*

![screenshot 2](prints/2.png)

*Configuração simples da home:*

![screenshot 3](prints/3.png)