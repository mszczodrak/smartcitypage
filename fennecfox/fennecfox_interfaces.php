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

<h2>Fennec Fox Network Protocol Stack Interfaces</h2>

<ul>
<li><a href="#application">Application</a></li>
<li><a href="#network">Network</a></li>
<li><a href="#mac">MAC</a></li>
<li><a href="#radio">Radio</a></li>
</ul>

<a name="application">
<h3>Application</h3>
</a>

<p>
Provides Interfaces
<ul>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Mgmt.nc">Mgmt</a></li>
</ul>
</p>

<p>
Uses Interfaces
<ul>
<li><em>ApplicationModuleName</em>AppParams</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMSend.nc">AMSend</a> as NetworkAMSend</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMPacket.nc">AMPacket</a> as NetworkAMPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Packet.nc">Packet</a> as NetworkPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as NetworkReceive</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as NetworkSnoop</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/PacketAcknowledgements.nc">PacketAcknowledgements</a> as NetworkPacketAcknowledgements</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ModuleStatus.nc">ModuleStatus</a> as NetworkStatus</li>
</ul>
</p>

<a name="network">
<h3>Network</h3>
</a>

<p>
Provides Interfaces
<ul>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Mgmt.nc">Mgmt</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMSend.nc">AMSend</a> as NetworkAMSend</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMPacket.nc">AMPacket</a> as NetworkAMPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Packet.nc">Packet</a> as NetworkPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as NetworkReceive</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as NetworkSnoop</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/PacketAcknowledgements.nc">PacketAcknowledgements</a> as NetworkPacketAcknowledgements</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ModuleStatus.nc">ModuleStatus</a> as NetworkStatus</li>
</ul>
</p>

<p>
Uses Interfaces
<ul>
<li><em>NetworkModuleName</em>NetParams</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMSend.nc">AMSend</a> as MacAMSend</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMPacket.nc">AMPacket</a> as MacAMPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Packet.nc">Packet</a> as MacPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as MacReceive</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as MacSnoop</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/PacketAcknowledgements.nc">PacketAcknowledgements</a> as MacPacketAcknowledgements</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ModuleStatus.nc">ModuleStatus</a> as MacStatus</li>
</ul>
</p>

<a name="mac">
<h3>MAC</h3>
</a>

<p>
Provides Interfaces
<ul>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Mgmt.nc">Mgmt</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMSend.nc">AMSend</a> as MacAMSend</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/AMPacket.nc">AMPacket</a> as MacAMPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Packet.nc">Packet</a> as MacPacket</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as MacReceive</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Receive.nc">Receive</a> as MacSnoop</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/PacketAcknowledgements.nc">PacketAcknowledgements</a> as MacPacketAcknowledgements</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ModuleStatus.nc">ModuleStatus</a> as NetworkStatus</li>
</ul>
</p>

<p>
Uses Interfaces
<ul>
<li><em>MacModuleName</em>MacParams</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/RadioConfig.nc">RadioConfig</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/RadioPower.nc">RadioPower</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Read.nc">Read<uint16_t></a> as ReadRssi</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Resource.nc">Resource</a> as RadioResource</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/StdControl.nc">StdControl</a> as RadioControl</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/RadioTransmit.nc">RadioTransmit</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ReceiveIndicator.nc">ReceiveIndicator</a> as PacketIndicator</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ReceiveIndicator.nc">ReceiveIndicator</a> as ByteIndicator</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ReceiveIndicator.nc">ReceiveIndicator</a> as EnergyIndicator</li>
</ul>
</p>

<a name="radio">
<h3>Radio</h3>
</a>

<p>
Provides Interfaces
<ul>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Mgmt.nc">Mgmt</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/RadioConfig.nc">RadioConfig</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/RadioPower.nc">RadioPower</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Read.nc">Read<uint16_t></a> as ReadRssi</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/Resource.nc">Resource</a> as RadioResource</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/StdControl.nc">StdControl</a> as RadioControl</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/RadioTransmit.nc">RadioTransmit</a></li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ReceiveIndicator.nc">ReceiveIndicator</a> as PacketIndicator</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ReceiveIndicator.nc">ReceiveIndicator</a> as ByteIndicator</li>
<li><a href="https://github.com/mszczodrak/fennec-fox/blob/master/src/interfaces/ReceiveIndicator.nc">ReceiveIndicator</a> as EnergyIndicator</li>
</ul>
</p>

<p>
Uses Interfaces
<ul>
<li><em>RadioModuleName</em>RadioParams</li>
</ul>
</p>

<?php include("../footer.php"); ?>

