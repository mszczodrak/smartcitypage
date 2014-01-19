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


<p>
Fennec Fox provides a network communication protocol
stack with four layers. Each layers is supported by a
set of alternative modules, each implementing the full
layer functionality while being optimized for a target
performance metric.
At runtime, Fennec Fox dynamically adapts the network to
the given changes in the application scenarios by reconfiguring the
combination of modules that are executed for each layer.
</p>

<p>
In order to be compatible with the Fennec Fox network protocol
stack, a library module must provide and use the interfaces
of the layer that it becomes part of. Specifically, a module
provides an interface to
the upper layer by implementing the functions whose
definitions are part of that interface. A module, instead,
uses the interface provided by a lower layer by calling
functions defined by the interface and by implementing
signal handlers that are sent at runtime from the lower-level
modules. Figure below shows the top-down
bottom-up message exchange interfaces between the layers
of the network stack. 
</p>

<center>
<img src="./figs/interfaces_layers.png" height="400"/>
</center>

<p>
The figure also depicts horizontal
communication between the modules. Both network and MAC
type library modules are supported with the same or
two different addressing library modules, because Fennec Fox
decouples communication problems from addressing.
The Fennec Fox Control Unit uses management interface
<it>Mgmt</it> to start and stop execution of modules
across the layers of the network stack. The Control
Unit is also responsible for executing network
policies, keeping track of events, and synchronizing
all network nodes to the same configuration,
using Trickle-based state synchronization protocol.
</p>


<h3>Installation</h3>

<p>
Fennec Fox is the reconfigurable network protocol stack. By itself it is not an executable 
program, unless it is compiled and installed on a hardware mote. Therefore, for Fennec Fox
we provide the source code of the stack, and we set system environmental variable to point
to the location where the source code of the Fennec Fox is located.
</p>

<p>
After downloading the Fennec Fox, the fennecfox.tar.gz file, we move the file to a place
where we want to keep the source code (approximately 3MB). Once the code is in the right place
we do:
</p>

<pre>
$ tar -zxvf fennecfox.tar.gz
$ cd fennecfox
</pre>

<p>
Next we set the FENNEC_FOX_LIB envariomental variable to the location of the fennecfox/src folder.
</p>

<h3>Tutorial</h3>

<p>
NesC and TinyOS

Although the concept of the Fennec Fox network protocol stack
is independent from any implementation, the current version
requires knowledge of nesC and TinyOS.

The good nesC and TinyOS resources can be found at:

<ul>
<li><a href=http://docs.tinyos.net/tinywiki/index.php/Main_Page>Online</a></li>
<li><a href=http://www.amazon.com/TinyOS-Programming-Philip-Levis/dp/0521896061>Book</a></li>
</ul>

</p>


       
<h1>Fennec Fox Application Example</h1>

<p>
In this example, we show how to create a new application module. The new application
will attempt to send a uint16_t integer number from one mote (source) to another (destination),
every x milliseconds (which we call a delay). The integer number that source is sending at start
is set to 0, and after every successful transmission it is incremented by one.
</p>

<p>
First, let create a space and files where we can code the application. When do this, we need
to keep in mind the Fennec Fox naming convention. 
<i>Each application module code needs to
be stored in a separate directory, with the directory name set to the application name. Within
the direcotory, the main application has to have a name that is composed of application name and suffix 
<b>AppC.nc</b></i>. For example, we can call our application <i>Counter</i>, therefore the main application
file will called <i>CounterAppC.nc</i>. So, we can create files and our working space as follows:
</p>

<pre>
$ mkdir Counter
$ cd Counter
$ touch CounterAppC.nc
$ touch CounterAppP.nc
$ touch CounterApp.h
</pre>

<p>
The last two files will store the application code (in AppP.nc) and various declararions (in App.h). 
The AppC.nc file is the application components wiring all application components together. This is comming
from nesC, and in most cases does not require much work while creating new Fennec Fox modules.
</p>

<p>
We said before that application will send an integer packet from one mote to another We can define
the application packet structure in the <b>CounterApp.h</b> file, as follows:
</p>

<pre>
#ifndef _COUNTER_H
#define _COUNTER_H

typedef nx_struct {
&nbsp;&nbsp;&nbsp;   nx_uint16_t counter;
} counter_msg_t;

#endif
</pre>

<p>
Note that this is the same syntax as in C. Next, the <b>CounterAppC.nc</b> component is defined as follows:
</p>

<pre>
 1 generic configuration CounterAppC(uint16_t delay, uint16_t source, uint16_t destination) {
 2 &nbsp;&nbsp;&nbsp;  provides interface Mgmt;
 3 &nbsp;&nbsp;&nbsp;  provides interface Module;
 4 &nbsp;&nbsp;&nbsp;  uses interface NetworkCall;
 5 &nbsp;&nbsp;&nbsp;  uses interface NetworkSignal;
 6 }
 7
 8 implementation {
 9 
10 &nbsp;&nbsp;&nbsp;  components new CounterAppP(delay, source, destination);
11 &nbsp;&nbsp;&nbsp;  Mgmt = CounterAppP;
12 &nbsp;&nbsp;&nbsp;  Module = CounterAppP;
13 &nbsp;&nbsp;&nbsp;  NetworkCall = CounterAppP;
14 &nbsp;&nbsp;&nbsp;  NetworkSignal = CounterAppP;
15 
16 &nbsp;&nbsp;&nbsp;  components new TimerMilliC() as Timer0;
17 &nbsp;&nbsp;&nbsp;  CounterAppP.Timer0 -> Timer0;
18 }
</pre>

<p>
This code defines the Counter application wiring and the main interface. First, note that in the first line
the code says that the application CounterAppC takes three arguments: delay, source, and destination - each
defined according to the application specification, as discussed in the first paragraph. Note, that these
parameters are the same that we can specify in the Swift Fox programs. In other words, in Swift Fox programmers
says what should be the value for destination, soure, and delay.
</p>

<p>
Next, the code says that this application module provides two interfaces (Mgmt and Module) and uses two interfaces (NetworkCall and NetworkSignal).
The main component of every Fennec Fox module must provide Mgmt and Module. To send data across the network, applications are using network
services provided by the network interfaces. NetworkCall allows an application to send request to the network layer, and NetworkSignal
allows network protocols to send information or data to the application layer.
</p>

<p>
Finally, we specify the high level implementation of the Counter Application. The aplication code, the actual logic,
is implemented in the <b>CounterAppP</b> (line 10).  Note, that we pass further the same parameters that we received on line 1.
On lines 11-14 we are rewiring all interfaces comming to the <b>CounterAppC</b> to the file <b>CounterAppP</b>.Since we need to keep
tract of time (to delay message transmission), we need to connect our application to the Timer component, as shown on lines
16-17. 
</p>

<p>
The syntax of this wiring follows nesC, therefore, please refer to nesC documentation if this is confusing.
</p>

<pre>
  1 #include <Fennec.h>
  2 #include "CounterApp.h"
  3 
  4 generic module CounterAppP(uint16_t delay, uint16_t src, uint16_t dest) {
  5 &nbsp;&nbsp;&nbsp;  provides interface Mgmt;
  6 &nbsp;&nbsp;&nbsp;  provides interface Module;
  7 &nbsp;&nbsp;&nbsp;  uses interface Leds;
  8 &nbsp;&nbsp;&nbsp;  uses interface Timer<TMilli> as Timer0;
  9 &nbsp;&nbsp;&nbsp;  uses interface NetworkCall;
 10 &nbsp;&nbsp;&nbsp;  uses interface NetworkSignal;
 11 }
 12 
 13 implementation {
 14 
 15 &nbsp;&nbsp;&nbsp;  uint16_t counter;
 16 
 17 &nbsp;&nbsp;&nbsp;  command error_t Mgmt.start() {
 18 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    counter = 0;
 19 
 20 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    switch(TOS_NODE_ID) {
 21 
 22 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      case dest:
 23 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        break;
 24 
 25 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      case src:
 26 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        call Timer0.startPeriodic(delay);
 27 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        break;
 28 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    }
 29 
 30 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    signal Mgmt.startDone(SUCCESS);
 31 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    return SUCCESS;
 32 &nbsp;&nbsp;&nbsp;  }
 33 
 34 &nbsp;&nbsp;&nbsp;  command error_t Mgmt.stop() {
 35 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    call Timer0.stop();
 36 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    call Leds.set(0);
 37 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    signal Mgmt.stopDone(SUCCESS);
 38 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    return SUCCESS;
 39 &nbsp;&nbsp;&nbsp;  }
 40 
 41 &nbsp;&nbsp;&nbsp;  event void Timer0.fired() {
 42 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    counter_msg_t *c;
 43 
 44 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    msg_t* message = signal Module.next_message();
 45 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    if (message == NULL) return;
 46 
 47 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    c = (counter_msg_t*) call NetworkCall.getPayload(message);
 48 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    if (c == NULL) {
 49 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      signal Module.drop_message(message);
 50 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      return;
 51 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    }
 52 
 53 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    call Leds.set(counter);
 54 
 55 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    c->counter = counter;
 56 
 57 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    message->len = sizeof(counter_msg_t);
 58 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    message->next_hop = dest;
 59 
 60 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    dbg("Application", "Application Sending %d\n", counter);
 61 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    if (call NetworkCall.send(message) != SUCCESS) {
 62 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      signal Module.drop_message(message);
 63 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    }
 64 &nbsp;&nbsp;&nbsp;  }
 65 
 66 &nbsp;&nbsp;&nbsp;  event void NetworkSignal.sendDone(msg_t *msg, error_t err) {
 67 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    if (err == SUCCESS) counter++;
 68 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    signal Module.drop_message(msg);
 69 &nbsp;&nbsp;&nbsp;  }
 70 
 71 &nbsp;&nbsp;&nbsp;  event void NetworkSignal.receive(msg_t *msg, uint8_t *payload, uint8_t size) {
 72 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    counter_msg_t *c = (counter_msg_t*)payload;
 73 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    call Leds.set(c->counter);
 74 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    dbg("Application", "Application Receiving %d\n", c->counter);
 75 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    signal Module.drop_message(msg);
 76 &nbsp;&nbsp;&nbsp;  }
 77 }
</pre>


<?php include("../footer.php"); ?>
