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


<h3>Swift Fox Installation</h3>

<p>
Swift Fox is the programming language that allows to program logic specifying when and how
Fennec Fox stack should be reconfigured. Swift Fox is a compiler in itself, but before we
can use it we need to compile it from a source code.
</p>

<p>
Swift Fox source code relies on the following tools that should be avaivale in the system: lex and yacc.
Before we install Swift Fox, we need to install these tools. For example, in Ubuntu the same tools have different
names and can be installed in the following way:
<pre>
$ sudo apt-get install bison flex
</pre>
</p>

<p>
Once lex and yacc are installed, download the latest release of 
the Swift Fox Compiler from 
<a href="../releases/swift-fox-compiler-0.79.tar.gz">here</a> and follow
the installation process 
<pre>
$ tar -zxvf swift-fox-compiler-*.tar.gz
$ cd swift-fox-compiler-*
$ ./configure
$ make
$ sudo make install
</pre>
If no errors appeared, you should be able to run <b>sfc</b> Swift Fox compiler
from the shell as follows:
<pre>
$ sfc
sfc: no input files

If your source program is located in sample.sfp and sample.sfl, then run:

$ sfc sample
</pre>
</p>

<p>
The older releases can be found in the
<a href="../releases">releases directory</a>
</p>


<p>
If you wish to browse the source code of the Swift Fox compiler,
check its repository 
<a href="https://github.com/mszczodrak/swift-fox">on github</a>.
</p>

<?php include("../footer.php"); ?>
