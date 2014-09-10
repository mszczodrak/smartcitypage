<?php include("../info.php"); ?>
<body>

<center>
<table>
<tr><td colspan=2>
<?php include("../banner.php"); ?>
</td></tr>

<td aligh='right' valign='top' width='200px'>
<?php include("../menu.php"); ?>
</td>
<td align='left' valign='top' width='700px'>


<h3>Compiler Architecture</h3>

<p>
Swift Fox compiler is written in C using Flex and Bison libraries. 
<a href="http://flex.sourceforge.net/">Flex</a> is a tool for generating
lexical analyzers and it is an open version of 
<a href="http://en.wikipedia.org/wiki/Lex_%28software%29">lex</a>.
Bison is a parser generator and it is a GNU version of 
<a href="http://en.wikipedia.org/wiki/Yacc">yacc</a>. 
The generated output of the Swift Fox program is nesC code.
</p>

<center>
<img src="./figs/swift_fox_arch.png" height="400"/>
</center>


       
<h3>History</h3>

<p>
The first idea of a high-level programming language for Fennec Fox platform 
emerged around December 2009. At this time, Fennec Fox (FF) consisted of only two layers: 
Application and Network. Around beginning of February 2010, as part of a
project for class Programming Languages and Translators tought by prof. Alfred Aho,
a group of four students was formed to design and implement the first 
prototype of the Swift Fox compiler. Those students were: Marcin Szczodrak,
Vasileios P. Kemerlis, Xuan Linh Vu, and Yiwei Gu.
</p>

<p>
Over the following months, Fennec Fox network protocol stack has been growing,
untill a point, where the stack consisted of four layers: Application, Network,
MAC, and Radio. By the end of 2010, Swift Fox was supporting all the layers of
the Fennec Fox stack, and allowed to specify addressing scheme supporting
network and MAC protocols. 
</p>

<p>
During CPSWeek conference taking place in Chicago (April 2011), Marcin
discussed with Om the Fennec Fox architecture and the Swift Fox programming
language. Om has suggested to extend Swift Fox such that each module 
of a FF configuration could be parameterized. On August 11, 2011, the first
version of the SF compiler supporting modules parameterization was released. 
</p>


