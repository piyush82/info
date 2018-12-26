<html>
<head>
<title>Piyush Harsh</title>
<style type="text/css">
	A:link {text-decoration: none; color:#336699}
	A:visited {text-decoration: none; color:#336699;}
	A:active {text-decoration: none}
	A:hover {text-decoration: underline; color: #FFFFFF;}
</style>
<link rel="icon" type="image/png" href="https://www.cons.cise.ufl.edu/favicon.png">
<link rel="stylesheet" type="text/css" media="screen,print" href="style.css">
<script type="text/javascript">
<!--
function changeColor(id, color)
{
	var elx;
        elx=document.getElementById(id);
        if(elx)
        {
		elx.style.background=color;
	}
}
function hideElement(id)
{
        var elx;
        elx=document.getElementById(id);
        if(elx)
        {
                elx.style.visibility='hidden';
                //document.getElementById('main').style.visibility='visible';
                //document.getElementById('main').style.disabled=false;
        }
}
function showElement(id)
{
        var elx;
        elx=document.getElementById(id);
        if(elx)
        {
                elx.style.visibility='visible';
		elx.style.left=(screen.width - 980)/2;
		elx.style.top=(screen.height - 695)/2;
                //document.getElementById('main').style.visibility='visible';
                //document.getElementById('main').style.disabled=false;
        }
}
function expand1()
{
	document.getElementById('paper1').innerHTML = 
	'<b>Abstract</b><br>mDNS is a proposed DNS-aware, hierarchical, '
	+ 'and scalable multicast session directory architecture that '
	+ 'enables multicast session registration and makes them dis'
	+ 'coverable in real time. It supports domain-specific as well '
	+ 'as global searches for candidate sessions. '
	+ 'This paper improves mDNS global search algorithm and '
	+ 'addresses various security and scalability concerns that '
	+ 'remained in mDNS. We propose distributing the overall '
	+ 'keyword space among designated MSD servers using hash '
	+ 'values. In contrast to other P2P keyword search approaches, '
	+ 'we propose IP style prefix routing on the keyword hashes to '
	+ 'locate the appropriate MSD server in order to register or '
	+ 'retrieve any globally-scoped multicast session. This supports '
	+ 'efficient and fast distributed keyword search.'
	+ '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse1();\">less</a></div>';
}
function collapse1()
{
	document.getElementById('paper1').innerHTML =
	'<b>Abstract</b><br>mDNS is a proposed DNS-aware, hierarchical, '
        + 'and scalable multicast session directory architecture that '
        + 'enables multicast session registration and makes them dis'   
        + 'coverable in real time. It supports domain-specific as well '
        + 'as global searches for candidate sessions. '
        + 'This paper improves mDNS global search algorithm and '
        + 'addresses various security and scalability concerns that '
	+ '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand1();\">more</a></div>';
}
function expand2()
{
	document.getElementById('paper2').innerHTML = '<b>Abstract</b><br>'
	+ 'IP multicast is increasingly seen as efficient mode of live content distribution '
	+ 'in the Internet to significantly large subscriber bases. Despite its numerous '
	+ 'benefits over IP unicast, multicast has not seen widespread deployment over modern '
	+ 'networks. Network complexity and session discovery issues have plagued IP multicast '
	+ 'since its inception. The Internet research community is in '
	+ 'general agreement to move over to SSM (Source Specific Multicast).'
	+ '<br><br> '
	+ 'With IGMP v 3 (Internet Group Management Protocol) and SSM, the source discovery burden '
	+ 'will rest with the end user. Channel discovery is one of the few stumbling '
	+ 'blocks remaining to be solved for successful and widespread '
	+ 'deployment of multicast. In an earlier work a DNS (Domain Name System) aware '
	+ 'multicast session discovery architecture, mDNS, has been proposed which is '
	+ 'distributed, hierarchical and globally scalable.'
	+ '<br><br>'
	+ 'This paper proposes to leverage the mDNS architecture by enabling multicast '
	+ 'sessions to be tagged using geographical and spatial information based on the '
	+ 'channel contents or service provider location. It further proposes '
	+ 'automatic geo-coding of session registration information as the content provider '
	+ 'registers session information with mDNS. It also provides necessary design changes '
	+ 'and gives data models and data structures to support seamless '
	+ 'location sensitive session retrieval as part of search query results to be furnished '
	+ 'to the end user. The paper includes envisaged scenarios in which geo-tagging '
	+ 'would enhance end user experience and would enable smarter query result generation.'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse2();\">less</a></div>';
}
function collapse2()
{
        document.getElementById('paper2').innerHTML = '<b>Abstract</b><br>'                                          
        + 'IP multicast is increasingly seen as efficient mode of live content distribution '
        + 'in the Internet to significantly large subscriber bases. Despite its numerous '
        + 'benefits over IP unicast, multicast has not seen widespread deployment over modern '
        + 'networks. Network complexity and session discovery issues have plagued IP multicast '
        + 'since its inception. The Internet research community is in '
        + 'general agreement to move over to SSM (Source Specific Multicast).'
        + '<br><br> '
        + 'With IGMP v 3 (Internet Group Management Protocol) and SSM, the source discovery burden '
        + 'will rest with the end user. Channel discovery is one of the few stumbling '
        + 'blocks remaining to be solved for successful'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand2();\">more</a></div>';
}
function expand3()  
{
        document.getElementById('paper3').innerHTML = '<b>Abstract</b><br>'
	+ 'Bandwidth in the Internet is constantly increasing. The last mile problem of the Internet '
	+ 'has almost been solved. Multimedia has emerged as a dominant type of '
	+ 'traffic on the Internet. Multicast is increasingly seen as the delivery vehicle of choice for '
	+ 'multimedia streams. What has been the one true stumbling roadblock in widespread use of '
	+ 'multicast is the lack of a convenient mechanism '
	+ 'for multicast session discovery. This paper examines existing techniques that '
	+ 'try to address this issue, highlighting the benefits and drawbacks of such schemes. '
	+ 'It then proposes our hierarchical and globally scalable session '
	+ 'directory architecture. An analysis of benefits and drawbacks '
	+ 'of our scheme follows. The paper concludes with arguments why our scheme might be '
	+ 'generally more suitable for global deployment, which may allow end users to enjoy the '
	+ 'true power and efficiency of IP multicast.'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse3();\">less</a></div>';
}
function collapse3()
{
        document.getElementById('paper3').innerHTML = '<b>Abstract</b><br>'
        + 'Bandwidth in the Internet is constantly increasing. The last mile problem of the Internet '
        + 'has almost been solved. Multimedia has emerged as a dominant type of '
        + 'traffic on the Internet. Multicast is increasingly seen as the delivery vehicle of choice for '
        + 'multimedia streams. What has been the one true stumbling roadblock in widespread use of '
        + 'multicast is the lack of a convenient mechanism '
        + 'for multicast session discovery. This paper examines existing techniques that '
        + 'try to address this issue, highlighting'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand3();\">more</a></div>';
}
function expand4()
{
        document.getElementById('paper4').innerHTML = '<b>Abstract</b><br>'
	+ 'Before multicast applications start transmitting content must choose a multicast channel on ' 
	+ 'which to transmit. Unlike IP unicast addresses, multicast addresses '
	+ 'normally are not long lived entities. Moreover many applications can choose to transmit data '
	+ 'on the same channel. Every application that chooses to transmit data intended for receivers ' 
	+ 'outside its own administrative domain must choose a globally scoped channel. '
	+ 'Since most of globally scoped multicast channel addresses are not statically assigned, there '
	+ 'is a high probability of address collision among applications if they are assigned addresses randomly '
	+ 'and without the prior knowledge of global assignments of such addresses. This paper proposes '
	+ 'an overlay solution to dynamic globally scoped multicast address allocation and collision prevention.'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse4();\">less</a></div>';
}
function collapse4()
{
        document.getElementById('paper4').innerHTML = '<b>Abstract</b><br>'
	+ 'Before multicast applications start transmitting content, they must choose a multicast channel on '
        + 'which to transmit. Unlike IP unicast addresses, multicast addresses '
        + 'normally are not long lived entities. Moreover many applications can choose to transmit data '
        + 'on the same channel. Every application that chooses to transmit data intended for receivers '
        + 'outside its own administrative domain must choose a globally scoped channel. '
        + 'Since most of globally scoped multicast channel addresses are not'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand4();\">more</a></div>';
}
function expand5()
{
	document.getElementById('paper5').innerHTML = '<b>Abstract</b><br>'
	+ 'In this paper we describe architectural changes incorporated into mDNS (DNS aware Multicast Session Directory) that '
	+ 'enable it to co-exist in both ASM and SSM multicast environments. mDNS is a distributed, global, scalable and '
	+ 'hierarchical approach that allows multicast sessions to be searched based on multiple parameters including keywords, '
	+ 'session-type, geo-locality, etc. mDNS design being tightly coupled with existing DNS service enables sessions to be ' 
	+ 'assigned a URL that can be book-marked for future access.<br><br>'

	+ 'We also describe the caching strategy added to mDNS and present arguments on its possible benefits. Further we '
	+ 'will discuss the slight search strategy alteration necessitated by caching and its security implications. This paper also '
	+ 'describes our simulation design. We describe how we automated our experiments. The integration of fully '
	+ 'implemented mDNS software and our simulated network hierarchy will be explained. We provide simulation results and '
	+ 'explain their significance with respect to network topography.'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse5();\">less</a></div>';
}
function collapse5()
{
        document.getElementById('paper5').innerHTML = '<b>Abstract</b><br>'
	+ 'In this paper we describe architectural changes incorporated into mDNS (DNS aware Multicast Session Directory) that '
        + 'enable it to co-exist in both ASM and SSM multicast environments. mDNS is a distributed, global, scalable and '
        + 'hierarchical approach that allows multicast sessions to be searched based on multiple parameters including keywords,'
	+ '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand5();\">more</a></div>';
}
function expand6()
{
        document.getElementById('paper6').innerHTML = '<b>Abstract</b><br>'
	+ 'Modern networks are very complex. It is highly desirable to reduce management complexity in next generation networks '
	+ 'design. Researchers have been seeking inspiration in natural observations to help better manage the ever increasing '
	+ 'complexity of modern networks. Bio-inspired and cognitive networks have shown tremendous promise towards better '
	+ 'adapting networks to local stimuli intelligently, and to some extent without human intervention.<br><br>'

	+ 'In this paper, we discuss why the human brain is an excellent model for designing next generation smart networks. '
	+ 'Insights gained into macro-behavior of human brain and its structural organization in the last decade are discussed. We '
	+ 'identify features that can be adapted for network modeling. We then propose a network design model based on our '
	+ 'understanding of the mind, how cognition is achieved, how memory is formed, etc. We end this paper with a real life '
	+ 'network design problem we address using the proposed general model.'
	+ '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse6();\">less</a></div>';
}
function collapse6()
{
        document.getElementById('paper6').innerHTML = '<b>Abstract</b><br>'
	+ 'Modern networks are very complex. It is highly desirable to reduce management complexity in next generation networks '
        + 'design. Researchers have been seeking inspiration in natural observations to help better manage the ever increasing '
        + 'complexity of modern networks. Bio-inspired and cognitive networks have shown tremendous promise towards better '
        + 'adapting networks to local stimuli intelligently, and to some extent without human intervention.'
	+ '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand6();\">more</a></div>';
}
function expand7()
{
        document.getElementById('paper7').innerHTML = '<b>Abstract</b><br>'
	+ 'mDNS - a hierarchical multicast session directory service architecture, which has been recently submitted '
	+ 'to IETF editorial board for publication under Best Current Practice (BCP) track, allows administrative domains to join '
	+ 'the global hierarchy incrementally. The global structure dynamically adapts to the changing topology. This paper '
	+ 'describes the various failure scenarios in the proposed IETF document and especially the scenario where a participating '
	+ 'domain goes down completely. It describes how such a scenario could effect end users’ experience and how te '
	+ 'system can temporarily recover from such failures until the erring domain can be revived.'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse7();\">less</a></div>'; 
}
function collapse7()
{
        document.getElementById('paper7').innerHTML = '<b>Abstract</b><br>'
        + 'mDNS - a hierarchical multicast session directory service architecture, which has been recently submitted '  
        + 'to IETF editorial board for publication under Best Current Practice (BCP) track, allows administrative domains to join '
        + 'the global hierarchy incrementally. The global structure dynamically adapts to the changing topology. This paper '
        + 'describes the various failure scenarios in the proposed IETF document and especially the scenario where a participating '
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand7();\">more</a></div>';  
}
function expand8()
{
	document.getElementById('paper8').innerHTML = '<b>Abstract</b><br>'
        + 'Cloud computing is quickly defining the computing paradigm in the modern '
	+ 'networked age. Users can run their large computations online using cloud '
	+ 'services at a fraction of the cost compared to setting their own data centers. '
	+ 'Clearly cloud computing offers many advantages, and yet many large organizations '
	+ 'including governments, financial sector, and health care sector are reluctant '
	+ 'in transitioning to cloud computing. Contrail project will address the major '
	+ 'concerns behind this reluctance namely mistrust in cloud platforms, lack '
	+ 'of Service Level Agreements (SLAs) and Quality of Protection (QoP) of data. '
	+ 'Contrail will provide a federation layer support for bringing a multitude of '
	+ 'cloud providers, both private and public, together. This will allow '
	+ 'multi-tenancy and cloud-bursting capability to end user cloud applications while '
	+ 'supporting SLAs and QoP agreements desired by several privacy aware sectors '
	+ 'including governments, banks, health care providers to name a few. This paper '
	+ 'describes the novel features we are building into the Contrail Virtual Execution '
	+ 'Platform (VEP) that will be closely interfaced with the IaaS layer of cloud '
	+ 'providers. VEP upgrades the supported cloud providers and brings trust in cloud '
	+ 'computing by adding SLAs and QoP features missing at typical IaaS layer. Further '
	+ 'this paper outlines challenges faced in being part of a large federation and '
	+ 'how VEP will address some of those.'
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:collapse8();\">less</a></div>';
}
function collapse8()
{
        document.getElementById('paper8').innerHTML = '<b>Abstract</b><br>'
	+ 'Cloud computing is quickly defining the computing paradigm in the modern '
        + 'networked age. Users can run their large computations online using cloud '
        + 'services at a fraction of the cost compared to setting their own data centers. '
        + 'Clearly cloud computing offers many advantages, and yet many large organizations '
        + 'including governments, financial sector, and health care sector are reluctant '
        + '<div style=\"text-align:right;\"><a href=\"javascript:void(0);\" onClick=\"javascript:expand8();\">more</a></div>';
}
//-->
</script>
</head>

<body style="background:#515151;">
<div style="text-align:center;">
	<div style="margin-bottom:10px;margin-left:auto;margin-right:auto;margin-top:10px;overflow:hidden;position:relative;word-wrap:break-word; 
	background:#ffffff;text-align:left;width:780px;" id="content">
		<div style="margin-left:15px;position:relative;width:750px;z-index:0;" id="navbar">
		<table style="border:0px;background:#FFFFFF;margin-top:5px;">
		<tr>
			<td id="link1" onMouseOver="javascript:changeColor('link1', '#E3E4FA');" 
				onMouseOut="javascript:changeColor('link1','#FFFFFF');" 
					style="text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:70px;">
					<a href="index.php" style="text-decoration:none;">Home</a>
			<td id="link2" onMouseOver="javascript:changeColor('link2', '#E3E4FA');"
                                onMouseOut="javascript:changeColor('link2','#FFFFFF');"
                                        style="text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:90px;">
                                	<a href="research.php" style="text-decoration:none;">Research</a>
			<td id="link3" onMouseOver="javascript:changeColor('link3', '#E3E4FA');"
                                onMouseOut="javascript:changeColor('link3','#E3E4FA');"
                                        style="background:#E3E4FA;text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:110px;">
                                	<a href="javascript:void(0);" style="text-decoration:none;">Publications</a>
			<td id="link4" onMouseOver="javascript:changeColor('link4', '#E3E4FA');"
                                onMouseOut="javascript:changeColor('link4','#FFFFFF');"
                                        style="text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:110px;">
                                        <a href="presentations.php" style="text-decoration:none;">Presentations</a>
			<td id="link5" onMouseOver="javascript:changeColor('link5', '#E3E4FA');" 
				onMouseOut="javascript:changeColor('link5','#FFFFFF');"
                                        style="text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:90px;">
                                	<a href="teaching.php" style="text-decoration:none;">Teaching</a>
			<td id="link6" onMouseOver="javascript:changeColor('link6', '#E3E4FA');"
                                onMouseOut="javascript:changeColor('link6','#FFFFFF');"
                                        style="text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:90px;">
                                        <a href="service.php" style="text-decoration:none;">Service</a>
			<td id="link7" onMouseOver="javascript:changeColor('link7', '#E3E4FA');"
                                onMouseOut="javascript:changeColor('link7','#FFFFFF');"
                                        style="text-align:center;font-family:Verdana;font-size:10pt;font-weight:bold;width:180px;;">
                                        <a href="career.php" style="text-decoration:none;">Career Development</a>
		</table>
		</div>

		<div style="margin-left:10px;position:relative;width:760px;z-index:0;" id="topbarline">
		<hr style="color:#003366;height:3px;background:#003366;border:0px;margin-left:10px;margin-right:10px;">
		</div>

		<div style="margin-left:0px;margin-right:0px;position:relative;width:780px;z-index:0;" id="titlebar">
		<table style="border:0px;background:#FFFFFF;margin-bottom:10px;margin-left:45px;margin-right:45px;" align="center">
		<tr>
		<td style="text-align:left;width:250px;font-family:'ArialMT', 'Arial', sans-serif;font-size:36px;color:#003333;">Piyush Harsh
		<td style="text-align:right;width:420px;font-family:'ArialMT', 'Arial', sans-serif;font-size:36px;color:#333366;font-weight:normal;">publications
		</table>
		</div>

		<div style="margin-left:40px;position:relative;width:750px;z-index:0;margin-right:40px;" id="content">
		<table style="background:#FFFFFF;width:700px;" cellspacing="0">
		<tr>
			<td style="background:white;width:470px;" valign="top">
                                <div style="margin-top:1px;position:relative;width:489px;z-index:0;height:176px;background:#98AFC7;">
                                        <image src="image/page3img1.jpg" style="width:469px;height:156px;margin-left:10px;margin-top:10px;">
                                </div>
				<div style="margin-top:1px;position:relative;width:489px;z-index:0;height:133px;background:#98AFC7;">
                                        <image src="image/page3img2.jpg" style="width:469px;height:113px;margin-left:10px;margin-top:10px;">
                                </div>
                                <div style="margin-top:1px;position:relative;width:489px;z-index:0;background:#FFFFFF;">
                                        <div style="margin-top:10px;margin-left:5px;font-family:'ArialMT', 'Arial', sans-serif;font-size:12pt;font-weight:bold;color:#566D7E;">
                                        Research Publications
                                        <hr style="margin-top:5px;margin-bottom:0px;border:0px;background:gray;color:gray;height:2px;">
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_2">
                                        Here are the list of papers that have already been published or have been accepted for publication:
                               	</div>
                               	
               <div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
              		<span class="style_4"><b>Managing OVF applications under SLA constraints on Contrail Virtual Execution Platform
             		<a href="javascript:void(0);" title="accepted, to appear">&#8224;</a></b></span>
               </div>
               <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
               	Yvon Jegou & Piyush Harsh & Roberto G. Cascella & Florian Dudouet & Christine Morin<br>
             		DMTF SVM '12, Oct 26 2012, Las Vegas, USA.
              	</div>
					<div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
						<table style="border:0px;background:#FFFFFF;">
							<tr>
								<td style="width:50px;background:#FFFFFF;" valign="top">
									<a href="content/svm-01-12-draft.pdf" target="_blank"
									title="download the full text ...">
									<image src="image/pdf.png" style="width:50px;height:50px;">
									</a>
									<div style="margin-top:3px;"></div>
								<td>
									<div id="paper9" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
										<b>Abstract</b><br>
										The move of users and organizations to Cloud computing will become possible when they will be able to exploit their own applications,
										 applications and services provided by cloud providers as well as applications from third party providers in a trustful way on different 
										 cloud infrastructures. To reach this goal, standard application formats must be enabled on the cloud to avoid vendor-lockin, and 
										 guarantees concerning protection, performance and security supported.<br><br>
										 
										This article describes the Contrail VEP component developed by the Contrail project. The VEP component is in charge of managing the 
										whole life cycle of OVF distributed applications under Service Level Agreement rules on different infrastructure providers.
									</div>
						</table>
					</div>
					
					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
              		<span class="style_4"><b>Using Open Standards for Interoperability - Issues, Solutions, and Challenges facing Cloud Computing
             		<a href="javascript:void(0);" title="accepted, to appear">&#8224;</a></b></span>
               </div>
               <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
               	Piyush Harsh & Florian Dudouet & Roberto G. Cascella & Yvon Jegou & Christine Morin<br>
             		DMTF SVM '12, Oct 26 2012, Las Vegas, USA.
              	</div>
					<div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
						<table style="border:0px;background:#FFFFFF;">
							<tr>
								<td style="width:50px;background:#FFFFFF;" valign="top">
									<a href="content/svm-02-12-draft.pdf" target="_blank"
									title="download the full text ...">
									<image src="image/pdf.png" style="width:50px;height:50px;">
									</a>
									<div style="margin-top:3px;"></div>
								<td>
									<div id="paper9" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
										<b>Abstract</b><br>
										Virtualization offers several benefits for optimal resource utilization over traditional non-virtualized server farms. 
										With improvements in internetworking technologies and increase in network bandwidth speeds, a new era of computing has been ushered 
										in, that of grids and clouds. With several commercial cloud providers coming up, each with their own APIs, application description 
										formats, and varying support for SLAs, vendor lock-in has become a serious issue for end users. This article attempts to describe 
										the problem, issues, possible solutions and challenges in achieving cloud interoperability. These issues will be analyzed in 
										the ambit of the European project Contrail that is trying to adopt open standards with available virtualization solutions 
										to enhance users' trust in the clouds by attempting to prevent vendor lock-ins, supporting and enforcing SLAs together with 
										adequate data protection for sensitive data.
									</div>
						</table>
					</div>
                                        
					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Contrail: A reliable and trustworthy cloud platform
                                        <a href="javascript:void(0);" title="invited paper">&#8224;</a></b></span>
                                       	</div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Roberto Cascella & Christine Morin & Piyush Harsh & Yvon Jegou<br>
                                        Proceedings of the 1st European Workshop on Dependable Cloud Computing, EWDCC '12, May 08-11 2012, Sibiu, Romania.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                    	<td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a href="content/ewdcc12.pdf" target="_blank"
                                                                        title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                        <td>
                                                            	<div id="paper9" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>First few lines</b><br>
                                                                The advent of cloud computing is a new opportunity for companies to rely on highly dynamic distributed 
								infrastructures to offer services to their customers. While major companies might prefer to own the 
								infrastructure to have full control on the data and applications, SMEs look with interest to cloud 
								technology since they cannot afford the initial barrier cost to enter the market.
                                                                </div>
                                                </table>
                                        </div>

               				<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Contrail Virtual Execution Platform: Challenges in Being Part of a Large Federation 
                                        <a href="javascript:void(0);" title="invited paper">&#8224;</a></b></span>
                             		</div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Yvon Jegou & Roberto Cascella & Christina Morin<br>
                                        ServiceWave 2011, October 26 - 28 2011, Poznan Poland.
                                        </div>
					<div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a href="content/SWave2011.pdf" target="_blank"
                                                                        title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                        <td>
                                                                <div id="paper8" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
								Cloud computing is quickly defining the computing paradigm in the modern networked age. 
								Users can run their large computations online using cloud services at a fraction of the 
								cost compared to setting their own data centers. Clearly cloud computing offers many 
								advantages, and yet many large organizations including governments, financial sector, and 
								health care sector are reluctant 
								<div style="text-align:right;"><a href="javascript:void(0);" 
                                                                        onClick="javascript:expand8();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>An Experimental Study and Analysis of Crowds Based Anonymity</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Lokesh Kumar Bhoobalan & Piyush Harsh<br>
                                        ICOMP 2011, July 18 - 21 2011, Las Vegas USA.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a href="content/ICOMP2011.pdf" target="_blank"
                                                                        title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                        <td>
                                                                <div id="paper7" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
                                                             	Crowds provides probable innocence in the face of large number of attackers. In this paper, we present the 
								experimental results of the behavior of Crowds in a dense network. We begin by providing a brief description 
								about Crowds followed by the experimental environment in which the simulations were carried out. We then 
								present the results of our simulations and the inferences made out of them. We will also show that the
								obtained results match the predictions made by others.
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Recovering from mDNS domain failures</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        ICOMP 2010, July 12 - 15 2010, Las Vegas USA.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/ICOMP2010.pdf" target="_blank"
                                                                        title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                        <td>
                                                                <div id="paper7" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
                                                                mDNS - a hierarchical multicast session directory service architecture, which has been recently submitted 
        							to IETF editorial board for publication under Best Current Practice (BCP) track, allows administrative domains to join 
        							the global hierarchy incrementally. The global structure dynamically adapts to the changing topology. This paper 
        							describes the various failure scenarios in the proposed IETF document and especially the scenario where a participating 
                                                                <div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand7();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>
					
					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Gray Networking - a step towards next generation computer networks</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Randy Chow & Richard Newman<br>
                                        ACM SIGAPP SAC 2010, March 22 - 26 2010, Crans-Montana Switzerland.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/SAC2010-SCS.pdf" target="_blank"
                                                                        title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                        <td>
                                                                <div id="paper6" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
                                                                Modern networks are very complex. It is highly desirable to reduce management complexity in next generation
								networks design. Researchers have been seeking inspiration in natural observations to help better manage the
								ever increasing complexity of modern networks. Bio-inspired and cognitive networks have shown tremendous
								promise towards better adapting networks to local stimuli intelligently, and to some extent without human
								intervention.
                                                                <div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand6();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Mode Independent Session Directory Service Architecture</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        ACM SIGAPP SAC 2010, March 22 - 26 2010, Crans-Montana Switzerland.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/SAC2010-NETS.pdf" target="_blank" 
                                                                        title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                                <a
href="http://128.227.170.50/mdns/" target="_blank" title="access research page
...">
                                                                        <image src="image/url.jpg" style="width:50px;height:50px;">
                                                                </a>
                                                        <td>
                                                                <div id="paper5" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
                                                                In this paper we describe architectural changes incorporated into mDNS (DNS aware Multicast Session
								Directory) that enable it to co-exist in both ASM and SSM multicast environments. 
								mDNS is a distributed, global, scalable and hierarchical approach that allows multicast 
								sessions to be searched based on multiple parameters including keywords,
                                                                <div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand5();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Efficient Distributed Search for Multicast Session Keywords</b></span>
                                        </div>
					<div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4"> 
                                        Piyush Harsh & Richard Newman<br>
					ICOMP 2009, July 13 - 16 2009, Las Vegas USA.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/ICM4728.pdf" target="_blank" 
									title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
								<div style="margin-top:3px;"></div>
								<a
href="http://128.227.170.50/mdns/" target="_blank" title="access research page
...">
                                                                        <image src="image/url.jpg" style="width:50px;height:50px;">
                                                                </a>
                                                        <td>
                                                                <div id="paper1" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
								<b>Abstract</b><br>
								mDNS is a proposed DNS-aware, hierarchical,
								and scalable multicast session directory architecture that
								enables multicast session registration and makes them discoverable in real time. 
								It supports domain-specific as well
								as global searches for candidate sessions.
								This paper improves mDNS global search algorithm and
								addresses various security and scalability concerns that
								<div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand1();">more</a></div>
								</div>
                                                </table>   
                                        </div>					
			
					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Using GeoSpatial session tagging for smart Multicast session discovery</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        ACM SIGAPP SAC 2009, March 8 - 12 2009, Honolulu - Hawaii USA.
                                        </div>
					<div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/SAC2009.pdf" target="_blank" title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                                <a href="http://portal.acm.org/citation.cfm?doid=1529282.1529287" target="_blank" title="access acm link for this content ...">
                                                                        <image src="image/acm.jpg" style="width:50px;height:50px;">
                                                                </a>
								<div style="margin-top:3px;"></div>
                                                                <a href="http://dblp.uni-trier.de/rec/bibtex/conf/sac/HarshN09" target="_blank" title="access BibTeX entry for this content ...">
                                                                        <image src="image/bibtex.png" style="width:50px;height:50px;">
                                                                </a>
                                                        <td>
                                                                <div id="paper2" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
								IP multicast is increasingly seen as efficient mode of live content distribution 
								in the Internet to significantly large subscriber bases. Despite its numerous
								benefits over IP unicast, multicast has not seen widespread deployment over modern 
								networks. Network complexity and session discovery issues have plagued IP multicast 
								since its inception. The Internet research community is in
								general agreement to move over to SSM (Source Specific Multicast).
								<br><br>
								With IGMP v 3 (Internet Group Management Protocol) and SSM, the source discovery burden 
								will rest with the end user. Channel discovery is one of the few stumbling 
								blocks remaining to be solved for successful 
								<div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand2();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>mDNS - A Proposal for Hierarchical Multicast Session Directory Architecture</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        ICOMP 2008, July 14 - 17 2008, Las Vegas USA.
                                        </div>
					<div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/ICM3400.pdf" target="_blank" title="download the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                                <a href="http://dblp.uni-trier.de/rec/bibtex/conf/ic/HarshN08" target="_blank" title="access BibTeX entry for this content ...">
                                                                        <image src="image/bibtex.png" style="width:50px;height:50px;">
                                                                </a>
                                                        <td>
                                                                <div id="paper3" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
								Bandwidth in the Internet is constantly increasing. The last mile problem of the Internet 
								has almost been solved. Multimedia has emerged as a dominant type of
								traffic on the Internet. Multicast is increasingly seen as the delivery vehicle of choice for 
								multimedia streams. What has been the one true stumbling roadblock in widespread use of 
								multicast is the lack of a convenient mechanism
								for multicast session discovery. This paper examines existing techniques that 
								try to address this issue, highlighting 
								<div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand3();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>
					
					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>An Overlay solution to IP-Multicast Address Collision Prevention</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        IASTED EuroIMSA 2008, March 17-19 2008, Innsbruck Austria.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/EuroIMSA08_Final.pdf" target="_blank" title="download the full
text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                                <a href="http://www.actapress.com/PaperInfo.aspx?PaperID=32967" target="_blank" title="access publisher page for this content ...">
                                                                        <image src="image/iasted.gif" style="width:50px;height:50px;">
                                                                </a>
                                                        <td>
                                                                <div id="paper4" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
								Before multicast applications start transmitting content, they must choose a multicast channel on 
								which to transmit. Unlike IP unicast addresses, multicast addresses
								normally are not long lived entities. Moreover many applications can choose to transmit data 
								on the same channel. Every application that chooses to transmit data intended for receivers 
								outside its own administrative domain must choose a globally scoped channel. 
								Since most of globally scoped multicast channel addresses are not 
                                                                <div style="text-align:right;"><a href="javascript:void(0);" onClick="javascript:expand4();">more</a></div>
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Usability and Acceptance of UF-IBA, An Image Based Authentication System</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        IEEE ICCST 2007, October 8-11 2007, Ontario Canada.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/Carnahan-07.pdf" target="_blank" title="download
the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                                <a href="http://ieeexplore.ieee.org/xpl/freeabs_all.jsp?arnumber=4373502" target="_blank" title="access IEEE page for this content ...">
                                                                        <image src="image/ieee.png" style="width:50px;height:62px;">
                                                                </a>
								<div style="margin-top:3px;"></div>
                                                                <a
href="citation/ieee-2.bib" target="_blank" title="access BibTeX entry for this
content ...">
                                                                        <image src="image/bibtex.png" style="width:50px;height:50px;">
                                                                </a>
                                                        <td>
                                                                <div id="paper5" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
								Text-based username-password systems have been traditionally used in authenticating users before allowing 
								them access to online services. Psychological studies have shown users' inability to recall random sequences 
								of alpha-numeric strings, which theoretically make the best passwords. Image-based authentication (IBA) 
								systems show great promise in circumventing users' inherent weakness. This
								paper provides design details of a fully functional experimental IBA system 
								deployed at the University of Florida's CISE department, exposes issues faced 
								by the researchers regarding user acceptance, and suggests how to make such
								IBA systems more usable. This paper further provides key usability insights gained from 
								analyzing the log files of users using the system over a period of more than two semesters.
                                                                </div>
                                                </table>
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Security Analysis of and proposal for Image based authentication</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Richard Newman & Piyush Harsh & Prashant Jayaraman<br>
                                        IEEE ICCST 2005, October 11-14 2007, Gran de Canarias, Spain.
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                                <table style="border:0px;background:#FFFFFF;">
                                                <tr>
                                                        <td style="width:50px;background:#FFFFFF;" valign="top">
                                                                <a
href="content/Carnahan-05.pdf" target="_blank" title="download
the full text ...">
                                                                        <image src="image/pdf.png" style="width:50px;height:50px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
								<a href="http://ieeexplore.ieee.org/xpl/freeabs_all.jsp?arnumber=1594881" target="_blank" title="access IEEE page for this content ...">
                                                                        <image src="image/ieee.png" style="width:50px;height:62px;">
                                                                </a>
                                                                <div style="margin-top:3px;"></div>
                                                                <a
href="citation/ieee-1.bib" target="_blank" title="access BibTeX entry for this
content ...">
                                                                        <image src="image/bibtex.png" style="width:50px;height:50px;">
                                                                </a>
                                                        <td valign="top">
                                                                <div id="paper6" style="margin-left:5px;font-family:Verdana;font-size:8pt;color:navy;text-align:justify;">
                                                                <b>Abstract</b><br>
								Most human authentication systems have been text-based. Recent psychological studies show 
								users' inability to recall random character sequences. Image-based
								authentication systems have shown promise in circumventing this problem. In addition, they are 
								more intuitive and user-friendly. This paper presents and 
								analyzes a user authentication technique using images that can be used in
								local as well as remote authentication. We also consider TEMPEST and other forms of attack.
                                                                </div>
                                                </table>
                                        </div>

                                        <div style="margin-top:10px;margin-left:5px;font-family:'ArialMT', 'Arial', sans-serif;font-size:12pt;font-weight:bold;color:#566D7E;">
                                        Manuscripts Under Development
                                        <hr style="margin-top:5px;margin-bottom:0px;border:0px;background:gray;color:gray;height:2px;">
                                        </div>
                                        <div style="margin-top:0px;margin-left:5px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_2">
                                        Here are the list of manuscripts that are under development or have been submitted and are under review:
                                        </div>

					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">
                                        <span class="style_4"><b>Delivering on-demand multimedia using IP multicast</b></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:25px;margin-bottom:20px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        Target Congerence :: TBD
                                        </div>
					
					<div style="margin-top:0px;margin-left:5px;margin-bottom:0px;color:#2B3856;" class="paragraph_style_2">   
                                        <span class="style_4"><b>IETF RFC - A Hierarchical Multicast Session Directory Service Architecture</b></span></span>
                                        </div>
                                        <div style="margin-top:0px;margin-left:25px;margin-bottom:5px;color:#2B3856;" class="paragraph_style_4">
                                        Piyush Harsh & Richard Newman<br>
                                        Target :: IETF Editorial Board<br>
					Submitted :: November 16, 2009, Expires :: May 20, 2010<br>
					Link to the submitted draft :: <a href="https://datatracker.ietf.org/doc/draft-mdns-rfc-informational/" target="_blank">[IETF LINK]</a>
                                        </div>
                                </div>
			<td style="background:white;width:230px;" valign="top">
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:226px;background:#98AFC7;">
					<image src="image/page3img3.jpg" style="width:190px;height:206px;margin-left:10px;margin-top:10px;">
				</div>
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:83px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:9pt;text-align:left;font-weight:normal;color:navy;">
						Photographs: Top-Left Clockwise - Sunset at Waikiki beach, Hawaii; lighthouse in Honolulu; our bikes at Withlacoochee bike trail.
					</div>
                                </div>
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
						<a href="research.php">Research & Experience</a>
					</div>
                                </div>
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#FFFFFF;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="javascript:void(0);" style="text-decoration:none;"">Publications</a>
                                        </div>
                                </div>
                                <div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="presentations.php">Presentations</a>
                                        </div>
                                </div>
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="teaching.php">Teaching Experience</a>
                                        </div>
                                </div>
                                <div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="service.php">Service & Awards</a>
                                        </div>
                                </div>
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:12pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="career.php">Professional Development</a>
                                        </div>
                                </div>
                                <div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
					<div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="content/Curriculum-Vitae.pdf" target="_blank">Curriculum Vitae</a>
                                        </div>
                                </div>
				<div style="margin:1px;position:relative;width:210px;z-index:0;height:40px;background:#98AFC7;">
                                        <div style="padding:10px;font-family:'ArialMT', 'Arial', sans-serif;font-size:13pt;text-align:left;font-weight:normal;color:navy;">
                                                <a href="colleagues.php">Research Colleagues</a>
                                        </div>
                                </div>
		</table>
		</div>

		<div style="margin-left:15px;position:relative;width:750px;z-index:0;padding:0px;" id="footerbarline">
		<hr style="margin-left:10px;margin-right:10px;border:0px;color:#003300;height:3px;background:#003300;">
		</div>

		<div style="margin-bottom:10px;position:relative;width:780px;z-index:0;" id="footer">
		<table style="border:0px;background:#FFFFFF;width:750px;margin-left:10px;margin-right:10px;margin-top:-5px;">
                <tr>
			<td style="background:#FFFFFF;">
			<div style="text-align:center;font-family:'Helvetica Neue';font-size:.8em;color:green;word-wrap:break-word;margin:10px;">
			<a href="http://128.227.170.50/" 
			style="text-decoration:dash;color:green;font-family:'Arial-BoldMT', 'Arial', sans-serif;font-size:9pt;font-weight:bold;">
				CONS Lab:Center for OS, Networks & Security
			</a>
			</div>
			<td style="background:#FFFFFF;">
                        <div style="text-align:center;font-family:Helvetica;font-size:10pt;color:green;word-wrap:break-word;margin:10px;">
                        <a href="http://www.cise.ufl.edu/" 
			style="text-decoration:dash;color:green;font-family:'Arial-BoldMT', 'Arial', sans-serif;font-size:9pt;font-weight:bold;">
                        	Department of Computer & Information Science & Engineering
                        </a>
                        </div>
			<td style="background:#FFFFFF;">
                        <div style="text-align:center;font-family:Helvetica;font-size:10pt;color:green;word-wrap:break-word;margin:10px;">
                        <a href="http://www.eng.ufl.edu/" 
			style="text-decoration:dash;color:green;font-family:'Arial-BoldMT', 'Arial', sans-serif;font-size:9pt;font-weight:bold;">
                        	College of Engineering
                        </a>
                        </div>
			<td style="background:#FFFFFF;">
                        <div style="text-align:center;font-family:Helvetica;font-size:10pt;color:green;word-wrap:break-word;margin:10px;">
                        <a href="http://www.ufl.edu/" 
			style="text-decoration:dashes;color:green;font-family:'Arial-BoldMT', 'Arial', sans-serif;font-size:9pt;font-weight:bold;">
                        	University of Florida
                        </a>
                        </div>
                </table>
		</div>
	</div>
</div>

<!-- Start of StatCounter Code -->
<script type="text/javascript">
var sc_project=4981631; 
var sc_invisible=1; 
var sc_partition=57; 
var sc_click_stat=1; 
var sc_security="10771f2c"; 
</script>

<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script><noscript><div
class="statcounter"><a title="joomla 1.5 statistics"
href="http://www.statcounter.com/joomla/"
target="_blank"><img class="statcounter"
src="http://c.statcounter.com/4981631/0/10771f2c/1/"
alt="joomla 1.5 statistics" ></a></div></noscript>
<!-- End of StatCounter Code -->

</body>
</html>
