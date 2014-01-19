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

<ul>
<li><a href="#modules">Fennec Fox Library Modules</a></li>
<li><a href="#adding">Adding New Module</a></li>
</ul>

<h2>Fennec Fox Tutorial</h2>

<p>
Each configuration definition consists of a list of modules, each
one providing different service and taking various parameters. One can
think about those modules as of libraries that exist in other programming languages,
or a operating system modules that can be loaded dynamically such as
Linux drivers.
In other languages a programmer can write a complete program without using
any supporting libraries, or may refer to existing libraries and call
them when necessary, as long as the libraries names and function signatures
are known. For example, in C one can write a simple program that does nothing,
and this program will not include any libraries. However, once we add
a printf statements, the stdin library must be included. In Fennec Fox,
everything is about modules (libraries) and putting them together to 
specify a given network protocol stack configuration. 
</p>

<p>
Fennec Fox framework consists of a library of modules. When one downloads 
Fennec Fox source code, the code already includes modules ready to be used.
Those modules are part of the Fennec Fox standart library. Sometimes, however,
one may need to add a new module providing new application functionality or
new network protocol communication services. In those situations, new modules
have to be written and linked with the Fennec Fox framework.
</p>


<a name="modules">
<h3>Fennec Fox Library Modules</h3>
</a>

<p>
Fennec Fox modules are located in src/Application, src/Network, src/Mac, and
src/Radio for modules providing application, network, MAC, and radio layer
functionality. Each modules is stored in a seperate directory, and the code
of each modules is written in nesC programming language. Each module is linked
to Fennec Fox framework through Swift Fox library file. The Swift Fox library
file with a list of all Fennec Fox modules that are part of the standart
library can be found at <b>$FENNEC_FOX_LIB/support/sfc/fennec.sfl</b>.
The file consists of a list of library modules that are linked to Fennec
Fox and are visible to Swift Fox compiler. A sample few lines of this
file are pasted below:

<pre>
# Standard Fennec Fox Applications
use application blink $(FENNEC_FOX_LIB)/Application/tests/Blink (
        uint8_t led, uint16_t delay)

...

# Standard Fennec Fox Network Protocols
use mac nullMac $(FENNEC_FOX_LIB)/Mac/null ()
use mac broadcast $(FENNEC_FOX_LIB)/Mac/tests/broadcast ()
...
</pre>
Notice that each module entry specifies its name as it is used in Swift Fox,
the location of the source code of the module and the paramteres that
are passed to the module from the Swift Fox programs.
</p>

<p>
Fennec Fox assumes naming convention of all modules that are linked
to the framework. The module's files that are linking the module to 
the framework has name extention suggesting the network protocol
stack layer on which the module executes. The application modules 
have extention <b>App</b>, network modules have extention <b>Net</b>,
MAC modules have extention <b>Mac</b> and radio modules have extention
<b>Radio</b>. For example, lets look at the application layer blink
module, which source code can be found 
<a href="https://github.com/mszczodrak/fennec-fox/tree/master/src/Application/tests/Blink">
here</a>. Because the module is located in Blink directory, Fennec Fox
assumes that the nesC component wiring the module's functionality
is stored in <em>BlinkAppC.nc</em>, where <em>Blink</em> comes from the directory's name,
<em>App</em> is the Fennec Fox naming convention for application layer modules,
<em>C</em> is the nesC convention for naming configurations, and 
<em>.nc</em> is the file extention for nesC programs.
</p>

<a name="adding">
<h3>Adding New Module</h3>
</a>

<h4>Application layer modules</h4>

<p>
Adding new application module is probably the next most likely
programming activity beyong writing a Swift Fox program. In this 
part of the tutorial we assume that there are network, MAC, and radio
modules that provide sufficient functionality, but the application
module is missing.
</p>

<p>
At some moment we might need to write a new application module, with 
the following specifications:
<ul> 
<li>every minute, each mote needs to send to the gateway a uint16_t type number</li>
<li>after successful transmission, the value of the number needs to be increased by 1</li>
<li>when the gateway mote receives a packet it displays on its LEDs the last tree 
	bits of the number send from another other mote</li>
<li>the application name is <em>number</em> and it is 
	stored in <em>/tmp/Number</em> directory.</li>
</ul>
</p>

<p>
To simplify the programming of this application we will use an empty template
of the <em>null</em> application from Fennec Fox standard library. 
One way to create that template is to copy nullApp.h, nullAppC.nc, and 
nullAppP.nc files from Fennec's src/Application/null into /tmp/Number, and then
rename files as well as all the file name references within those files. To avoid
copying and renaming manually, alternatively one can use a script to make a
template copy. Simply go to src/Application and run create.sh script followed by the name
of the application, for example:
<pre>
$ ./create.sh Number
</pre>
which creates Number directory. Since the app's specs require to put this directory
into the /tmp folder, move Number into /tmp:
<pre>
$ mv Number /tmp
</pre>























<pre>
use application blink $(FENNEC_FOX_LIB)/Application/Blink
</pre>

<p>
provides a <b>blink</b> tag for application, which nesC code is stored in 
<b>$(FENNEC_FOX_LIB)/Application/Blink</b>. In Fennec Fox the names
of the files of the modules must follow naming convention.



 excepts to
see the configuration definition of the blink module in file Blink<b>AppC.nc</b>.
For example, to see the underlying nesC code executing <b>blink</b> module, we could do:
</p>

<pre>
$ more $FENNEC_FOX_LIB/Application/Blink/BlinkAppC.nc
</pre>

<p>
seeing some fragments of the code:
</p>

<pre>
generic configuration BlinkAppC(uint8_t led, uint16_t delay) {
   provides interface Mgmt;
   provides interface Module;
   uses interface NetworkCall;
   uses interface NetworkSignal;
}

implementation {
   components new BlinkAppP(led, delay);
   Mgmt = BlinkAppP;
   Module = BlinkAppP;
   NetworkCall = BlinkAppP;
...
</pre>


<p>
In a similar way a library name is traslated into a location of a nesC code,
new FF modules can be added to SF library. For example, a FF application called 
<b>Test</b>, which configuration is stored in file <b>TestAppC.nc</b>, that is located
somewhere in <b>/home</b>, say in <b>/home/code</b> would require additional
entry in <b>$(FENNEC_FOX_LIB)/support/sfc/fennec.sfl</b> to be visible in SF program:
</p>

<pre>
# Adding new Test Application
use application <b>newTest</b> /home/code/<b>Test</b>
</pre>

<p>
If the Test module, which configuration is stored in /home/code/Test/TestAppC.nc file
takes 3 parameters, say par1, par2, par3 and is defined as:
</p>

<pre>
generic configuration TestAppC(uint8_t par1, uint8_t par2, uint8_t par3) {
  provides interface Mgmt;
  provides interface Module;
...
</pre>

<p>
then in SF program we can refer to this module by name <b>newTest</b> followed by
the values of the 3 parameters. For example, a configuration definition would start as 
follows:
</p>

<pre>
configuration conf_name { <b>newTest(1, 2, 3)</b> # the Test application
&#160;&#160;&#160;...
</pre>

<?php include("../footer.php"); ?>
