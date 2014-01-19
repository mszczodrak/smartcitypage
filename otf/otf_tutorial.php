<?php include("../info.php"); ?>
<body>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (location.href.indexOf("http://github.com/mszczodrak/otf/wiki") == -1){
  window.setTimeout('window.location="http://github.com/mszczodrak/otf/wiki"; ',0);
}
// End -->
</SCRIPT>


<center>
<table>
<tr><td colspan=2>
<?php include("../banner.php"); ?>
</td></tr>

<td aligh='right' valign='top' width='200px'>
<?php include("../menu.php"); ?>
</td>
<td align='left' valign='top' width='700px'>

<h2>Open Testbed Framework: Tutorial</h2>

<p>
<font size='small'>
Tutorial maintained by <a href="http://www.cs.columbia.edu/~msz/">Marcin Szczodrak</a>.
Last updated: November 27, 2012.
</font>
</p>

<p>
This tutorial shows how to setup Open Testbed Framework. 
In particular, the tutorial goes over setting up the testbed
server back-end, testbed backbone network communication, 
and how to configure tools that are putting the testbed's
components together. The tutorial concludes with brief 
instructions on how to use the testbed in everyday work.
To keep the tutorial's story concrete, we assume that each 
testbed node is set up out of one WiFi router 
TP-Link TL-WR1043ND and one Zolertia Z1 mote.
</p>

<p>
In this tutorial, we show how to quickly assemble testbed
infrastructure. We show:
<ul>
<li><a href="#server_back_end">Setting Up Server Back-End</a></li>
<li><a href="#backbone_network">Setting Up Backbone Network</a></li>
<li><a href="#testbed_in_action">Testbed in Action</a></li>
</ul>
</p>


<a name="server_back_end"></a><h2>Setting Up Server Back-End</h2>

<p>
Let's start with downloading the Open Testbed Framework. The framework
is run as an open source project on github. 
A copy of the project can be found at
<a href="https://github.com/mszczodrak/otf">https://github.com/mszczodrak/otf</a>.
</p>

<p>
Let us start with setting up the testbed server backbone.
In this tutorial we discuss one of two ways of setting
up the testbed server; either by downloading already configured
virtual image of Ubuntu server, or by configuring your own server. 
<ul>
<li><a href="http://smartcity.cs.columbia.edu/software/Testbed_Server_Ubuntu_12_04_LTS.tar.gz">Download Server VM</a></li>
</ul>
</p>


<p>
To run the virtual machine server, please make sure that one of the following
is installed:
<ul>
<li>VMware Player (available for most platforms)</li>
<li>VMware Workstation (Windows, Linux)</li>
<li>VMware Fusion (OS X)</li>
<li>ESXi or some other cloud-based infrastructure</li>
</ul>
</p>

<center>
<a href="pics/testbed_login.png">
<img src="pics/testbed_login.png" width=650>
</a>
</center>


<p>
The trickiest part with setting up the VM server is to ensure that there is a
way of connecting to the server from Internet. In particular, we want
to have HTTP, SSH, and MySQL connections that require TCP ports 22, 80, 3306.
Since your VM runs as a client on your host (where the host is either some other
Linux system, or Windows or OS X, you need to ensure that connections to
the critical ports to your host are forwarded or bridged to the client - the
testbed server. While setting this up is host OS dependent and you might need
to google around to see how to make it work, the following steps should work in
many cases, so please give it a try.
</p>

<p>
While running the VM tools, go to VM->Setting. This should open
the Virtual Machine Settings window. Next, edit the configuration
for <em>Network Adapter</em>. In the Network Connections set the connection
to <em>Bridge</em> and save it. Next, go to the testbed server console and reboot
the server:
<pre>
$ reboot
</pre>
The network VM settings should look like on the picture below:
</p>

<center>
<a href="pics/virtual_machine_settings_bridge.png">
<img src="pics/virtual_machine_settings_bridge.png" width=650>
</a>
</center>


<p>
At this moment verify that the web server is running correctly.
From you local machine, use a browser and go to the following URL:
<pre>
http://<em>your_server_ip_address</em>/otf_mgmt
</pre>
you should see the homepage of the Open Testbed Framework.
</p>


<p>
After starting the server you should be able to login. The figure above shows
the server running on VMware Workstation 9.0.
The server is configured with the following accounts. The administrator
account is <em>testbed_admin</em> with password <em>td901nmX4</em>. 
The MySQL server <em>root</em> account has password <em>td901nmX4db</em>.
Additionally, the database server has two more accounts, one with
read access called <em>reader</em> and password <em>reader_pass</em>
and one with read/write access called <em>writer</em> and password <em>writer_pass</em>.
At this point, make sure that you can remotely connect to the MySQL server.
You can use MySQL Workbench running on your local computer to attempt
connection to the server.
</p>

<p>
Once the testbed is deployed and running, make sure to change the passwords
for all users, and update the credentials information in
the testbed tools. However, we suggest to change password after the testbed
is successfully setup.
</p>

<p>
Use the <em>testbed_admin</em> credentials to check your server IP address.
One way to do that is by using ifconfig command. From the shell, do the following:
<pre>
$ ifconfig
</pre>
and check the line for inet_addr. This line should show the testbed server IP address.
</p>


<center>
<a href="pics/mysql_workbench.png">
<img src="pics/mysql_workbench.png" width=650>
</a>
</center>

<p>
Check that database server is running.
Use any MySQL client to connect to the testbed server database.
For example, you can use MySQL Workbench client on Windows or Linux
to login to the database. The MySQL Workbench interface is shown on 
the picture above. Try to login into the testbed server database using
the <em>writer</em> account.
</p>

<p>
The next picture shows the content of the <em>log</em> table 
from the <em>testbed</em> database. The table stores log messages
collected from the motes. The table has the following columns:
<ul>
<li>timestamp_epoch_ms: time when a log message was received through USB from a mote</li>
<li>printf: specifies if the received log message is a text (1) or a sequence of bytes (0)</li>
<li>mote: id of a mote from which the log message comes from</li>
<li>data: the content of the log message</li>
</ul>
</p>

<center>
<a href="pics/mysql_log_example.png">
<img src="pics/mysql_log_example.png" width=650>
</a>
</center>


<p>
The next picture shows the content of the <em>platforms</em> table
from the <em>testbed</em> database. The table stores information
about types of the mote platforms.
</p>

<center>
<a href="pics/mysql_platforms.png">
<img src="pics/mysql_platforms.png" width=650>
</a>
</center>

<p>
The next picture shows the content of the <em>nodes</em> table
from the <em>testbed</em> database. The table stores information
about the testbed nodes. The table has the following columns:
<ul>
<li>id: identification number assigned to a node (the attached mote will get address assigned to this id)</li>
<li>ip: the IP address of a PC or a router to which the mote is attached to through USB</li>
<li>port: the TCP port on which ssh connection with a PC or a router can be initiated</li>
<li>serial_port: the physical serial port on a PC or a router to which a mote is attached to</li>
<li>platform: type of the mote platform</li>
<li>status: is mote enabled (0) or disabled (1)</li>
</ul>
</p>

<center>
<a href="pics/mysql_list_of_nodes.png">
<img src="pics/mysql_list_of_nodes.png" width=650>
</a>
</center>

<p>
To setup the testbed, one needs to know at least one IP address that can be used
as a gateway to the testbed. For example, if we setup the testbed with one
WiFi router connected to the Internet and the rest of the WiFi routers 
connected to the gateway through the WiFi mesh network, then all the nodes should
have the same IP because the gateway will forward messages from the outside
of the testbed to each WiFi router on different ports.
</p>

<p>
Before continuing, please find the IP address on which the gateway WiFi router 
will be running. If you do not know the IP at this moment, after the gateway router
is setup, please come beck here to this step to update the IP address of all the 
testbed nodes. 
</p>


<a name="backbone_network"></a><h2>Setting Up Backbone Network</h2>

<p>
The Open Testbed Framework uses WiFi routers to set up backbone network
communication between the testbed server and all the motes.
To start with setting up the backbone network, take each WiFi router and
install OpenWrt Linux embedded system of that router.
In the following steps we assume that we will use TP-Link TL-WR1043ND
router with the firmware image available at
<a href="http://downloads.openwrt.org/attitude_adjustment/12.09/ar71xx/generic/openwrt-ar71xx-generic-tl-wr1043nd-v1-squashfs-factory.bin">OpenWrt</a>.
For other routers, please consult the
<a href="http://wiki.openwrt.org/toh/start">OpenWrt website</a>.
</p>


<p>
You can refer to OpenWrt wiki or websites as 
<a href="http://sysadminman.net/blog/2012/vpnpbx-getting-started-3890">this one</a>
to read more on installing OpenWrt. In the essence,
take an Ethernet cable and plug one side to a PC and other side
to the router's LAN port (the yellow port on TP-Link 1043ND).
In the browser, enter <em>192.168.1.1 </em> in the URL field, and use
username <em>admin</em> and default password <em>admin</em> to login.
</p>

<p>
After getting into the router, navigate to the System Tools-> Firmware Upgrade
to flash new router firmware with OpenWrt. 
The picture below shows the firmware upgrade interface of TP-Link.
</p>

<center>
<a href="pics/TP-link_firmware_upgrade.png">
<img src="pics/TP-link_firmware_upgrade.png" width=650>
</a>
</center>

<p>
After the upgrade the router will restart, as shown below.
</p>

<center>
<a href="pics/openwrt_upgrade_restarting.png">
<img src="pics/openwrt_upgrade_restarting.png" width=650>
</a>
</center>

<p>
Note that the firmware upgrade interface must look different if you're
using different WiFi router or have already installed different firmware
on a router. For example, if you already have OpenWrt running on the router,
the firmware upgrade interface may look as on the picture below. 
When upgrading the firmware of existing OpenWrt, please make sure to 
uncheck 'Keep Settings' box right next to the firmware upload.
</p>

<center>
<a href="pics/openwrt_firmware.png">
<img src="pics/openwrt_firmware.png" width=650>
</a>
</center>

<p>
After restart, the router will be running OpenWrt. At this moment start
with setting up root password and enable ssh access to the router. 
To do this, telnet to the router and setup password:
<pre>
$ telnet 192.168.1.1
</pre>
You should see a screen as the one below:
</p>


<center>
<a href="pics/openwrt_first_telnet_login.png">
<img src="pics/openwrt_first_telnet_login.png" width=650>
</a>
</center>

<p>
After getting into the router, change the password as follows:
<pre>
$ passwd
</pre>
and logout
<pre>
$ exit
</pre>
To keep things according to the tutorial, let's change the password to <em>testbed-access</em>.
The picture below shows the screen from changing the password.
</p>


<center>
<a href="pics/openwrt_passwd.png">
<img src="pics/openwrt_passwd.png" width=650>
</a>
</center>


<p>
At this moment you should be able to ssh to the router. Try to do that as follows:
<pre>
$ ssh root@192.168.1.1
</pre>
and after login, please logout.
<pre>
$ exit
</pre>
This step is shown on the following picture.
</p>


<center>
<a href="pics/openwrt_first_ssh.png">
<img src="pics/openwrt_first_ssh.png" width=650>
</a>
</center>


<p>
After installing the OpenWrt Linux embedded system, we will install the necessary software.
First, attach another Ethernet cable with Internet access to the router's
WAN port (blue). Your Ethernet-Router-PC connection should resemble the one from
the picture below.
</p>

<center>
<a href="pics/cables.jpg">
<img src="pics/cables.jpg" width=650>
</a>
</center>


<p>
Once the router is connected to network and PC, login at the router from PC:
<pre>
$ ssh root@192.168.1.1
</pre>
and copy the content of the
<a href="https://github.com/mszczodrak/otf/blob/master/wifi_backbone/SOFTWARE">
SOFTWARE</a>
file from the otf repository, the wifi_backbone folder, into the shell.
Alternatively, you can install the necessary software by typing line by line
the content of the file:
<pre>
$ opkg update
$ opkg install kmod-usb-serial
$ opkg install kmod-usb-serial-ftdi
$ opkg install kmod-usb-serial-cp210x
$ opkg install python-mini
$ opkg install pyserial
$ opkg install olsrd
$ opkg install http://smartcity.cs.columbia.edu/openwrt/snapshots/trunk/ar71xx/packages/helloworld_0.01-1_ar71xx.ipk
$ opkg install http://smartcity.cs.columbia.edu/openwrt/snapshots/trunk/ar71xx/packages/serial2file_0.06-1_ar71xx.ipk
</pre>
This step will install all the necessary software including
USB drivers, python environment, and OTF opkg packages
for mote-to-router communication. The installation process should look something like the picture below:
</p>


<center>
<a href="pics/openwrt_installing_software.png">
<img src="pics/openwrt_installing_software.png" width=650>
</a>
</center>


<p>
Check that the software was installed. For example, run <em>helloworld</em> program:
<pre>
$ helloworld
</pre>
You should see output as on the picture below:
</p>

<center>
<a href="pics/openwrt_helloworld.png">
<img src="pics/openwrt_helloworld.png" width=650>
</a>
</center>

<p>
Next, we will configure every router to be part of the testbed backbone network
infrastructure. First, make sure that the copy of the otf repository has the same 
ssh keys as the server has. If you use the provided testbed server virtual image,
you can download the ssh keys from 
<a href="http://smartcity.cs.columbia.edu/otf/ssh_keys/">
http://smartcity.cs.columbia.edu/otf/ssh_keys/</a>.
Download the keys and place in the copy of the repository, under
<em>ssh_keys</em> folder. If you develop from a Linux system, do the following:
<pre>
$ cd ssh_keys
$ wget http://smartcity.cs.columbia.edu/otf/ssh_keys/id_rsa
$ wget http://smartcity.cs.columbia.edu/otf/ssh_keys/id_rsa.pub
</pre>
</p>

<p>
At the place where you have the otf repository, go to the wifi_backbone 
folder.
<pre>
$ cd wifi_backbone
</pre>
then, create backup configuration for each router using the <em>router_settings.sh</em>
script. For example, to create configuration for the gateway router with id 1, do
the following:
<pre>
$ ./router_settings.sh 1
</pre>
which will create a file <em>192.168.40.1.tar.gz</em>.
If you have more routers, mark each one with unique id, and setup a configuration
for each one of them. For example, if you have 4 more routers, do the following:
<pre>
$ ./router_settings.sh 2
$ ./router_settings.sh 3
$ ./router_settings.sh 4
$ ./router_settings.sh 5
</pre>
which will create files 192.168.40.2.tar.gz, 192.168.40.3.tar.gz,
192.168.40.4.tar.gz, 192.168.40.5.tar.gz.
</p>

<p>
In the next step, copy each configuration file to a router attached to the PC.
For example, to configure router #1, make sure that it is connected with the PC 
through Ethernet cable - on the router side the cable should be plug into
the LAN network (yellow).
Copy the file 192.168.40.1.tar.gz file into router's /tmp folder as follows:
<pre>
$ scp 192.168.40.1.tar.gz root@192.168.1.1:/tmp
</pre>
The picture below shows the same configuration upgrade process but for router
#3, therefore on the picture we upload a file called 192.168.40.3.tar.gz.
</p>

<center>
<a href="pics/openwrt_configuration_copy.png">
<img src="pics/openwrt_configuration_copy.png" width=650>
</a>
</center>

<p>
Next, login into the router 
<pre>
$ ssh root@192.168.1.1
</pre>
and install the router configuration
<pre>
$ cd /tmp
$ tar -zxvf 192.168.40.3.tar.gz
$ cd 192.168.40.3
$ ./install_backup.sh; exit
</pre>
After this, the router will reboot with new configurations: the IP
address of the router on the LAN network will be 192.168.40.1,
and the <em>root</em> account will be setup with password <em>testbed-access</em>.
</p>

<p>
Now the router is setup with new IP address from the 192.168.40.x network.
If the router was configured with the file 192.168.40.3.tar.gz, its new
IP is 192.168.40.3, so you can ssh to the router as follows:
<pre>
$ ssh root@192.168.40.3
</pre>
The picture below shows ssh connection to router #3.
</p>

<center>
<a href="pics/openwrt_login_after_configuration.png">
<img src="pics/openwrt_login_after_configuration.png" width=650>
</a>
</center>

<p>
Finally, take a USB cable and connect a mote to the router.
Reboot the router - this one is done ;D. Congratulations!
Unless this is the gateway router (usually #1), 
this router does not need any wired connection anymore, only the power source.
</p>

<p>
Now repeat the installation process with other routers. Create configuration
files and upload them to each router and continue setting up routers 2,3,4....
</p>

<p>
Once few routers are up and running, the WiFi mesh network together with its local
subnetworks looks as on the figure below:
</p>

<center>
<a href="pics/subnets.png">
<img src="pics/subnets.png" width=650>
</a>
</center>

<p>
Because the WiFi routers provide local network IP addresses on their LANs, when
a PC is connected through LAN to a router, that PC will get an IP address from 192.168.1.x
network, with the gateway IP on the WiFi router setup to 192.168.1.1. While this subnetwork
most likely will not be used by the testbed, it allows to inspect a malfunctioning router
by connecting a PC to it through LAN, and ssh to the router.
</p>

<p>
Now, before you can use the testbed, make sure that you check the IP address
of the router #1 that should be attached to Internet and which serves
as the testbed network gateway. Check the gateway's router IP and
make sure that this IP is saved in the testbed database, in the nodes table.
So lets say that you setup a 3 node testbed with the configuration as shown on the
picture below:
</p>

<center>
<a href="pics/final_3_node_setup.png">
<img src="pics/final_3_node_setup.png" width=650>
</a>
</center>

<p>
The picture above shows that the gateway has   IP address setup to
172.172.30.22 and that the server has IP 172.111.10.99. This mean that in the MySQL
database <em>nodes</em> table, we should update the IP address for all the nodes.
The next figure shows the updated entries in the table. Note that is shows the type
of the platform for each node setup to 2, where two points to TelosB node. If your
testbed has Z1 nodes, change the platform to 3.
</p>


<center>
<a href="pics/final_3_node_mysql.png">
<img src="pics/final_3_node_mysql.png" width=650>
</a>
</center>


<p>
By using the server's public IP, you should be able to connect
from any PC to the server and control the testbed. Use
the IP address in a place of the browser's URL and check if it works.
The picture below shows how one can connect to the testbed for
a 3-node setup shown above.
</p>


<center>
<a href="pics/final_3_node_web_interface.png">
<img src="pics/final_3_node_web_interface.png" width=650>
</a>
</center>


<p>
In the end, it is recommended to check the server configuration files.
First, login to the server and check the testbed git repository updates:
<pre>
$ ssh testbed_admin@server_ip
$ cd otf
$ git pull
</pre>
as shown on the picture below:
</p>


<center>
<a href="pics/final_server_login.png">
<img src="pics/final_server_login.png" width=650>
</a>
</center>


<p>
Try to also make yourself familiar with the testbed configuration files.
Those files are:
<pre>
otf/server/web/configuration.php
otf/server/web/deploy_image_consts.py
otf/server/log_daemon/user_deamon_conf.py
</pre>
Note that when you change any user passwords, or IP addresses
you should check if any of the configuration files do not
need to be updated. For example, if you would split the web
server from the MySQL server, the MySQL server's IP
address would have to be updated. In particular, the
<em>MYSQL_SERVER_IP</em> testbed variable would need to be changed.
</p>



<a name="testbed_in_action"></a><h2>Testbed in Action</h2>

<p>
Let us assume that we deploy 14 testbed nodes. Node #1 serves
as a gateway. Also, let us assume that nodes 1,2,3, are 4 are attached
to TelosB and nodes 5,6,7,8,9,10,11,12,13, and 14 are attached to Z1.
Such testbed would look like as the one shown on the figure below.
</p>


<center>
<a href="pics/14_node_network.png">
<img src="pics/14_node_network.png" width=650>
</a>
</center>


<p>
The figure above shows an example of a 14-node testbed. Notice
that the figure explains how the nodes get their ID numbers.
A mote attached to a router with IP 192.168.40.N get ID of value N.
Recall, that this node id and router IP information is stored in
the MySQL database, in the <em>nodes</em> table.
</p>


<p>
With the testbed setup, let's try to deploy a new firmware on one 
of the motes. To start with the firmware upgrade, use a browser
to go to the testbed web-based user interface at:
<pre>
http://<em>your_server_ip_address</em>/otf_mgmt
</pre>
Next, click on Testbed -> Upload Firmware, and you should
see a page similar to the one below.
</p>

<center>
<a href="pics/otf_interface_upload_firmware.png">
<img src="pics/otf_interface_upload_firmware.png" width=650>
</a>
</center>

<p>
The picture above shows an example of reconfiguring the firmware
for mote 1, which is of type TelosB. From all available motes
of type TelosB (1,2,3,4) a user chooses node 1, and points to
the place where the firmware is located on user's local machine. Let's assume that
the new program is a TinyOS or Swift Fox test program
printing 'Hello World!' message. Because the log output of this
program is text, the user checks the <em>printf</em> field.
After clinking <em>Submit</em> button, the testbed will
send the firmware to a router attached to mote 1, and flash
the firmware into the mote. This process should not take more
than 20-30 seconds, for reconfiguration of 1 or many more nodes.
</p>

<center>
<a href="pics/otf_interface_logs.png">
<img src="pics/otf_interface_logs.png" width=650>
</a>
</center>

<p>
The picture above shows logs collected from the testbed. 
The logs contain timestamps of the logs, marked when 
the router attached to the mote received each message.
Each row also specifies the format of the output logs,
the id of the mote sending the log message, and the log message
content.
</p>

<?php include("../footer.php"); ?>

