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
<li><a href="#starting">The minimum it takes to write Swift Fox programs</a></li>
<li><a href="#compilation">Swift Fox program compilation and installation</a></li>
<li><a href="#samples">Sample Programs</a></li>
</ul>

<h2>Swift Fox Tutorial</h2>

<b>Syntax and Semantics</b>
<p>
Every Swift Fox (SF) program consists of the following sections:
<ul>
<li>Definition of configurations
<li>Definition of events
<li>Definition of policies
<li>Initial State
</ul>
At minimum, a syntaticaly valid SF program must include
at least one configuration definition and the initial state. 
Definition of events and policies is optional. All four sections of
the Swift Fox program must follow the presented order.
</p>

<a name="starting">
<h3>The minimum it takes to write Swift Fox programs</h3>
</a>

<p>
<em>Configuration</em>: defines a single state of the network. It specifies
what modules of the Fennec Fox network stack should be active in the
given state; that is a configuration specifies what application, 
network protocol, MAC protocol, and radio should be used at a given time.
In a given configuration, each module behavior can be further customized
by passing values to parameters that a module expets to receive.
Each state configuration has unique name id. 
</p>

<p>
Configuration definition example:</br>
<pre>
configuration welcome { blink(1, 1024), 
			nullNet(), 
			nullMac(), 
			nullRadio() }
</pre>
The above slice of a SF program defines new configuration and gives it 
new name <em>welcome</em>. The welcome configuration, as any other valid
configuration, consists of four modules: blink, nullNet, nullMac, nullRadio,
which are running on the application, network, MAC, and radio layers of
the Fennec Fox network protocol stack. In each configuration, the names
of modules are followed by parantheses in which a list of values can be
passed to the module. In the presented example, blink module expects to
receive two parameters, and nullNet, nullMac, nullRadio do not receive
any parameters. The number, order, and the meaning of each module's parameters
is specific to only given module and can be refered to by checking module's
documentation and/or information withing the module's source code.
</p>

<p>
<em>Initial State</em>: The system of wirelessly connected motes
can consists of more than one state, which requires definition of
two or more configurations. Once a mote starts running, it knows
how to run network protocol stack in each of the configurations that
were defined in the Swift Fox program. The initial state specifyies
the name of the configuration that should be run as the first one,
right after the mote starts running.
</p>

<p>
Initial State statement example:</br>
<pre>
start welcome
</pre>
The above line of the SF program states that the mote should
adjust the Fennec Fox network protocol stack to execute modules
of the welcome configuration. This statement is valid only when
the name of the configuration is defined in the SF program.
</p>

<p>
At this moment, after understanding meaning of configurations and
the initial state, we can already write a simple Swift Fox program.
In fact, defining one configuration and the initial state is all
that is needed to write a single state programs.
</p>

<p>
At first, let's combine the two fragments of the Swift Fox
program presented above into one program, which
complete code looking as follows:
<pre>
configuration welcome { blink(1, 1024),
                        nullNet(),
                        nullMac(),
                        nullRadio() }
start welcome
</pre>
The above Swift Fox program defines one configuration: welcome, and 
this is the configuration that starts running after motes bootup. 
In the previous discussion of the configuration we haven't discuss
the meaning of the parameters for each module, and how to find them, so
here it comes.
</p>

<p>
There are two types of modules running across the layers of the network
protocol stack. One of them are part of the Fennec Fox standard 
library, the others are added into the framework by developers themselves.
How to build a new FF module is a seperate story and it can
be found in <a href="../fennecfox/fennecfox_tutorial.php">Fennec Fox Tutorial</a>.
</p>

<p>
The four modules listed in the welcome configuration are part of the 
Fennec Fox standard library. To learn about those modules
functionality and about the parameters that are passed to those
modules, one can refer to the 
<a href="../fennecfox/fennecfox_modules.php">Fennec Fox framework module documentation</a>.
For better understanding of how parameters influence a given
module performance, one can study the module's source code. 
For example, blink is an application module, which source code is stored
in src/Application/tests/Blink of the Fennec Fox library, and it
can be browsed 
<a href="https://github.com/mszczodrak/fennec-fox/tree/master/src/Application/tests/Blink">
here</a>. Inside the BlinkAppP.nc file we can search for calls
to BlinkAppParams interface. For example, on line 57, there is the following
statement:
<pre>
call Timer.startPeriodic(call BlinkAppParams.get_delay());
</pre>
which starts mote timer to fire periodically every <em>delay</em> milliseconds. On
line 77 the following code:
<pre>
call Leds.set(call BlinkAppParams.get_led())
</pre>
sets LEDs to blink value stored in variable <em>led</em>. So from this example we see
that the module uses two parameter variables called delay and led. The order
of those parameters can be found in the Fennec Fox library definition, stored
<a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/support/sfc/fennec.sfl">here</a>,
where we can find the following line:
<pre>
use application blink $(FENNEC_FOX_LIB)/Application/tests/Blink (
                                     uint8_t led, uint16_t delay)
</pre>
The line above tells Swift Fox compiler that there is a Fennec Fox
application module called blink. The module is located in the Fennec Fox
directory, under Application/tests/Blink path. The module expects to receive
two variables, led and delay of type uint8_t and uint16_t respectively.
</p>

<a name="compilation">
<h3>Compilation and Installation</h3>
</a>

<p>
Each Swift Fox program is stored in a file with extention <b>.sfp</b>. 
Lets use the above simple program with welcome configuration as an example
and store that code in <b>first_hello.sfp</b> file.
</p>

<p>
To compile this program we would use <b>sfc</b> command that start running
the Swift Fox compiler. For example:

<pre>
$ sfc first_hello.sfp
</pre>

or simply

<pre>
$ sfc first_hello
</pre>
</p>

<p>
At first, the Swift Fox compilers loads into memory the libraries of Fennec Fox modules.
Next, it parses the Swift Fox program and maps Fennec Fox module to the state configuration,
and creates a cache memory for all value parameters specified in the .sfp programs.
Successfully compilation of a program returns to schell without any error messages.
</p>

<p>
After compilation, the Fennec Fox framework is configured to run the system with
functionality programmed in the Swift Fox code. At the next step, the Fennec Fox
is linked with TinyOS libraries and compiles into machanie code that can run
on the motes themselves. The <b>fennec</b> command is used to compile Fennec Fox
into machine code for specific architecture. For example, to compile Fennec Fox for
telosB motes, one would run:

<pre>
$ fennec telosb
</pre>

similarly, to compile the Fennec Fox framework to Zolertia Z1 motes, one would run:

<pre>
$ fennec z1
</pre>
</p>

<p>
Similarly as in the TinyOS, one can request to install the image on a mote's 
hardware by adding the <b>install</b> parameter. For example, to compile Fennec
Fox to telosB architecture and install the system image on a telosb mote attached 
to developer computer's USB, one would run:

<pre>
$ fennec telosb install,13
</pre>

The parameters after install assigned to node a unique id, in this case #13.
</p>

<a name="samples">
<h3>Sample Programs</h3>
</a>

<p>
<b>Empty Program</b>
</p>

<p>
The next program defines an empty network stack configuration. Once instaled
one a mote, no application nor any protocol will be executing. Here is the code:

<pre>
# First empty program - btw, this is a comment ;-)
configuration null_conf { nullApp() nullNet() nullMac() nullRadio() }
start null_conf
</pre>

As you already noticed, # starts comment statements, and each of the
nullApp, nullNet, nullMac, and nullRadio modules does not take any
parameters. In fact, each of those modules provide minimum functionality
that has to be provided by a module to be compatible with Fennec Fox
network protocols, therefore it is recommended to develop new 
modules using the code of the null application, network, MAC, radio 
examples.

Oh, and btw, instead of keeping all module names on one line,
one can spread the names across the lines and embed comments statements

<pre>
configuration null_conf { nullApp() # this is an empty application
	nullNet() # network
	nullMac()
	# the previous one was MAC
	nullRadio() # and the module running on the radio layer
}
start null_conf
</pre>
</p>

<p>
<b>Simple Blinking</b>
</p>

<p>
The following program runs blink application that every 2000 milliseconds
switches on and off the mote's LEDs. When LEDs are on, they display
value 7, which sets first LED on (+1), second LED on (+2), and the third LED on (+4).
<pre>
configuration hello { <b>blink(7, 2000)</b> # application
	nullNet() # network
	nullMac() # mac
	nullRadio() # radio
}
start hello
</pre>
</p>

<p>
<b>Sending Counter</b>
</p>

<p>
This program runs the following modules across the network protocol stack:
counter application, broadcast network protocol, nullMac, and cc2420 radio driver.
The counter application sends every 3 * 1000 milliseconds a hello message 
from mote 2 to mote 8. The broadcast network protocol sends this message to every node
within the radio range. The nullMac does not add any new functionality, and simply
passes messages from network protocol to radio layer and vice-versa. Finally, the radio
cc2420 module is a driver to cc2420 radio microcontroller. 
<pre>
configuration share_counter { 
	counter(3, 1000, 2, 8)
	broadcast()
	nullMac()
	cc2420(2, 26, 31, 0, 0, 10, 10, 1, 1, 1)
}
start share_counter
</pre>
</p>


<?php include("../footer.php"); ?>
