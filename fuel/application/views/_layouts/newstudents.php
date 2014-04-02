<!DOCTYPE html> <!-- HTML5 declaration -->

<html>

	<head>
        <meta charset="UTF-8">
        <title><?=fuel_var('page_title')?></title>
        
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/newstudents.css">
        
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/main.js"></script>
		<script type="text/javascript" src="assets/js/jquery.pagescroller.lite.js"></script><!-- link pagescroller lite js file -->

		<script type="text/javascript">
			$(document).ready(function(){
				// initiate page scroller plugin
				$('body').pageScroller({
					navigation: '#navscroll'
				});
			});
		</script>
	</head>
	
	
	<body>
		<!-- top nav template -->
		<div id="nav"></div> <!-- using javascript to load nav.html -->   		
		
		<!-- nav scroll -->
		<div id="navscroll" class="pageScrollerNav standardNav right dark">
			<ul>
				<li><a href="#">Top</a></li>
				<li><a href="#">Taiwan Office</a></li>
				<li><a href="#">Materials Receiving</a></li>
				<li><a href="#">Important Notes</a></li>
				<li><a href="#">Experience Sharing</a></li>
				<li><a href="#">Useful Websites</a></li>
			</ul>
		</div>
	
		<!-- nav content -->
		<div id="wrapper">
			<div id="main">

				<!-- Top -->
				<div class="section">
		        	<h1>
		        		<?=fuel_var('top_heading', 'Top')?>
		        	</h1>
				
					<p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
						<span lang="EN-US" style="font-size: 10.0pt; font-family: 微軟正黑體,sans-serif">
							<?=fuel_var('top_sections')?>
						</span>
					</p>
				</div>
				
				
				<!--  USC Taiwan Office -->				
				<div class="section">
		        	<h1>
		        		<?=fuel_var('tw_office_heading', 'USC Taiwan Office')?>
		        	</h1>
					<p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
						<span lang="EN-US" style="font-size: 10.0pt; font-family: 微軟正黑體,sans-serif">
							<?=fuel_var('tw_office_sections')?>
						</span>
					</p>
					

				</div>				
				
				
				<!-- Materials You Will Receive -->
				<div class="section">
					<h1>Materials You Will Receive</h1>
					
					<p class="MsoNormal" style="margin-top: 0; margin-bottom: 0">
					<span style="font-size: 10.0pt; font-family: 微軟正黑體,sans-serif">
					正常的情況下，你應該會陸續收到：</span>
					
					<!-- Item 1 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">I-20 &amp; Admission Letter</a></span>
	                    <div class="content">
		                    <p>
								&nbsp;&nbsp;&nbsp;&nbsp; :收到後，請立即檢查各頁中您的名字等資料是否正確） 及<span lang="EN-US"> 
								Admission Office </span>發出的正式入學許可信<span lang="EN-US"> (</span>各學<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>院或系所發出的<span lang="EN-US">email </span>
								或書信僅為非正式錄取通知<span lang="EN-US">, </span>正式文件仍以<span lang="EN-US"> 
								Admission Office </span>發出的書面為主<span lang="EN-US">)<br>
								&nbsp;&nbsp;&nbsp;&nbsp; : </span>如果你本身為美籍學生<span lang="EN-US">, </span>不會收到<span lang="EN-US"> 
								I-20<br>
								&nbsp;&nbsp;&nbsp;&nbsp; : </span>如果你計畫帶家人赴美，請記得<span lang="EN-US"> I-20 </span>
								上必須有家人的正確姓名及生日等資料，否則必須請<span lang="EN-US"> admission <br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; office </span>重發。<span lang="EN-US">(</span>或是<span lang="EN-US"> 
								I-20</span>上有註明配偶及孩子可以使用同一張<span lang="EN-US"> I-20 </span>申請簽證<span lang="EN-US">)<br>
								&nbsp;&nbsp;&nbsp;&nbsp; : </span>配偶若以<span lang="EN-US"> F-2 </span>同行赴美後，申請到<span lang="EN-US"> 
								USC </span>或其他學校的入學，可當地直接轉換成<span lang="EN-US"> F1 </span>簽證。
		                    </p>
	                    </div>
	         		</div>
				
	                <!-- Item 2 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">Welcome to USC online booklet</a></span>
	                    <div class="content">
		                    <p>
								&nbsp;&nbsp;&nbsp;&nbsp; <span lang="EN-US">: </span>在接獲入學通知之後一段時間<span lang="EN-US">,
								</span>相關單位應該會通知可上網查看當年新版的<span lang="EN-US">Welcome to USC
								</span>手冊<span lang="EN-US">.&nbsp; </span>內文詳<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>列新生們必須知道或是留意的各種訊息<span lang="EN-US">, </span>及應辦事項<span lang="EN-US">.&nbsp;
								</span>建議同學們留意是否收到相關網頁連結<span lang="EN-US">.&nbsp; </span>若沒有<span lang="EN-US">,
								</span>可<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>隨時聯絡台北辦事處<span lang="EN-US">.</span>
		                    </p>
	                    </div>
	         		</div>
	         		
	                <!-- Item 3 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">Intent to Enroll</a></span>
	                    <div class="content">
		                    <p>
								&nbsp;&nbsp;&nbsp;&nbsp; : 一旦決定接受南加大的入學許可<span lang="EN-US">, </span>
								建議盡速上網向學校確認您的決定。
		                    </p>
	                    </div>
	         		</div>
					
	                <!-- Item 4 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">疫苗 &amp; 肺結核</a></span>
	                    <div class="content">
		                    <p>
								&nbsp;&nbsp;&nbsp;&nbsp; :學校<span lang="EN-US"> Health Center </span>
								針對入學新生有幾項要求<span lang="EN-US">.
								<a style="color: blue; text-decoration: underline; text-underline: single" href="http://www.usc.edu/student-affairs/Health_Center/uphc.new.students.shtml">
								<span lang="EN-US" style="color: olive">請留意網站上提供的細節</span></a><span style="color:gray">.</span><span style="color:red">
								</span>&nbsp;</span>其中針對台灣同學<span lang="EN-US">, </span>出發前可以<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>先準備的大概只有 <b><span lang="EN-US">[</span>麻疹<span lang="EN-US">3</span>合一疫苗<span lang="EN-US">]</span></b><span lang="EN-US">
								</span>的注射證明<span lang="EN-US">.&nbsp; </span>至於<span lang="EN-US">[</span>肺結核檢測<span lang="EN-US">],
								</span>學校<span style="color:red"> <span lang="EN-US">
								<a style="color: blue; text-decoration: underline; text-underline: single" href="http://www.usc.edu/student-affairs/Health_Center/ms.tuberculosis.screening.shtml">
								<span style="color: olive">Health Center</span></a></span></span><span lang="EN-US" style="color:gray">
								</span>自<span lang="EN-US">2006</span>年起針<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>對<span lang="EN-US"> [</span>肺結核檢測<span lang="EN-US">]
								</span>作出新規定<span lang="EN-US">.&nbsp; </span>僅接受在入學前<span lang="EN-US">6</span>個月內在美國或加拿大兩地作的肺結核檢測<span lang="EN-US">.
								</span>同時學校<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Health Center </span>不會寄出任何<span lang="EN-US"> &quot;</span>檢測或所謂體檢表<span lang="EN-US">&quot;.&nbsp;
								</span>請直接使用醫院或診所的正式英文證明即可<span lang="EN-US">. <br>
								&nbsp;&nbsp;&nbsp;&nbsp; : </span>若您不便行前處理疫苗部分<span lang="EN-US">, </span>
								到校後也可直接到學校的<span lang="EN-US"> Student Health Center </span>處理<span lang="EN-US">,
								</span>先自行付費<span lang="EN-US">, </span>事後您投保的<span lang="EN-US"><br>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; USC </span>學生保險會幫您支付絕大部分<span lang="EN-US"><br></span>	
		                    </p>
	                    </div>
	         		</div>
			
				</div>				
				
				
				<!-- Important Notes -->
				<div class="section">
					<h1>Important Notes</h1>
					
					
					<!-- Item 1 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">務必記得上網 [確認入學]&nbsp; Intent to Enroll Form</a></span>
	                    <div class="content">
		                    <p>
								<font size="2" face="微軟正黑體">如果確認你會入學，記得儘早上網確認  
								<a href="https://camel2.usc.edu/AdmGradCertification/Default.aspx" style="text-decoration: none">
								<font color="#808000">Intent to Enroll</font></a>。確認動作完成後, 
								學校系統大約需要48小時左右的作業時間.&nbsp; 之後你應該會接到郵件通知可開始啟動 USC 個人帳號等.&nbsp; 
								請同學們留意!<br>
				                絕大多數研究所部分對於外籍學生沒有明確的 deadline，若你的科系沒有設定，學校強烈建議大家最晚在開學前四週之前確認.&nbsp; 
								後續才有足夠的時間去處理一些相關行政配套等).&nbsp;
				            	大學部的回覆日期則相當嚴格，請務必遵守。如果您的系所訂有確切的回覆日期, 但您因故 (例如收件日太靠近回覆日等), 
								您可以自行寫信到系所請求再延展.&nbsp; 不過同意與否由各系所自行決定.</font>
		                    </p>
	                    </div>
	         		</div>
				
	                <!-- Item 2 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">因故無法如期入學&nbsp;&nbsp; Can not Enroll this Semester as originally planned?</a></span>
	                    <div class="content">
		                    <p>
								<font size="2" face="微軟正黑體">
								如果您因故無法在原本申請的學期入學，研究所部分：可以一方面去函您的科系告知你的狀況，然後勾選Intent to Enroll 
								Form 上的適當選項 (即要求 admission office 將你的申請案 update 到下一學期或學年)。</font><p style="margin-top: 0; margin-bottom: 0">
								<font size="2" face="微軟正黑體">Admission Office 會在收到你的 Application 
								Update Request Form 後，將你的申請資料移到下一期的申請者名單中，待下一期或下一學年再行審核一次。<br>
								<br>
								請留意: USC 並沒有 &quot;保留入學許可&quot; 的做法, 而是將申請檔案轉到申請人要求的下一學期或學年, 
								屆時會重新再審核<br>
				            	<br>
				            	(據可靠消息來源建議說, 研究生如果無法如預期的入學而必須 update application 的話, 
								可以在寫信給你科系之外, 再寄一封email 到</font><font face="微軟正黑體" color="navy" size="2"><span style="FONT-SIZE: 10pt; COLOR: navy; ">E:
				            	<a href="mailto:gradadm@usc.edu" style="color: blue; text-decoration: underline">
				            	gradadm@usc.edu</a>. </span></font><font face="微軟正黑體" size="2">
				            	<span style="font-size: 10pt; ">並附上所有個人相關基本資料及原因, 這樣子學校相關人員就會直接處理.&nbsp; 
								由於信件太多, 原則上學校並不會回覆要求 update application 的信. 除非是有資料不足.&nbsp; 
								不過你可以在一段時間後電話詢問一下Phone Center 確定即可.)<br>
				           	 	<br>
				            	</span></font><font size="2" color="#000080">
				            	<span style="font-family: 微軟正黑體">Phone Center</span></font><font face="微軟正黑體" color="navy" size="2"><span style="FONT-SIZE: 10pt; COLOR: navy; ">, 
								T: (213) 740-1111</span></font><font face="微軟正黑體"><font size="2"><br>
				            	<br>
				            	另，據了解，曾被錄取過的人，再被錄取的機率頗高，不過由於每年申請人的競爭不同, 
								各學院皆保留最後決定權，並不保證百分之百一定會再被錄取，尤其是博士班部分，因為相當程度必須視教授們新學期能再接受多少新生而異。至於大學部的新生則請儘早與</font><span lang="EN-US" style="mso-fareast-font-family:華康POP1體W5"><font size="2">                        
				            	admission office 連絡。</font></span></font>
		                    </p>
	                    </div>
	         		</div>
	         		
	                <!-- Item 3 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">赴美日期的挑選&nbsp; When to Leave for LA</a></span>
	                    <div class="content">
		                    <p>
				                <font size="2" face="微軟正黑體">
								根據學校課表，8月初是暑期班的期末考期間。留校上課的在校生多半在準備考試，接機人手可能會較缺乏。建議新生提早與同學會或有提供類似服務的學生團體先確認，以免屆時無人能幫忙。寒假期間則因多數學生轉赴他處放假，接機事宜必須請新生自行安排。（參考下方機場交通細節）(2003 
								秋季起 - 美國移民局新規定, 限制外籍學生必須於開學前一個月才能入境美國)<br>
				                <br>
				                *<font color="#FF0000">* 註</font><font color="#800000">: </font>
				                <font color="#FF0000"> 
				                需要參加開學前 ISE 英語測試的同學, 請務必安排在考試日期前抵達
				                </font>(一般會比國際學生的新生訓練日期早), 正確日期及考試地點請查詢學校負責測試相關單位網站</font><font color="#FF0000" size="2" face="微軟正黑體"> </font>
								<font size="2" face="微軟正黑體">(</font><font color="#FF0000" size="2" face="微軟正黑體"><a href="http://college.usc.edu/international-student-english-exam/" style="text-decoration: none"><font color="#808000">ALI</font></a></font><font size="2" face="微軟正黑體"><font color="#808080">
								</font>及 Testing Bureau), 如果希望跟 Orientation Advisors 取得連絡, 可以查詢<font color="#808000">
								</font> 
				                </font><font color="#FF0000" size="2"> 
				                <a href="http://sait.usc.edu/orientation/contact_oa.html" style="text-decoration: none">
				                <font color="#808000" face="微軟正黑體">Orientation Office</font></a></font><font size="2" face="微軟正黑體" color="#FF0000"> </font>
								<font size="2" face="微軟正黑體">的網頁</font>
		                    </p>
	                    </div>
	         		</div>
					
	                <!-- Item 4 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">學費&nbsp;&nbsp; Tuition</a></span>
	                    <div class="content">
		                    <p>
			                	<font size="2" face="微軟正黑體">學校最近一學期的學費及雜費相關資料，網路上可以<a href="http://www.usc.edu/students/enrollment/classes/" style="text-decoration: none"><font color="#808000">查詢</font></a>。其中，大學部一學期如果修12-18 
								學分，或研究所15-18 學分，學校有個所謂的 flat fee 
								制度，也就是說例如你是大學部學生，某個學期你計畫修15或18學分，那麼你還是只需付12學分的費用。<br>
			                	<br>
			                	另外, 究竟要繳多少學費, 實際數字必須等到你進行完繳費前的所有註冊相關動作 (包括選課, 
								及多數人需要的英語測試等), 學校才有辦法算出你究竟該學期得繳多少錢.&nbsp; 如果你很希望先有個大概數, 
								建議跟同科系的在校生義工學長姐們問問 看。(I-20上也有提供建議數字, 學費部分可參考, 生活費則互有差異)</font>
		                    </p>
	                    </div>	
	                </div>				
					
	                <!-- Item 5 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">如何繳學費?&nbsp;&nbsp; How to Pay for Your Tuition?</a></span>
	                    <div class="content">
		                    <p>
								<font face="微軟正黑體" size="2">
				                有些同學在出發前會很擔心付學費的事, 原則上, 如上所述, 新生得一直等到 &quot;選課註冊&quot; 後, 才會知道自己的總額。 
								建議可先使用 I-20 上的預估的金額進行安排.&nbsp;<a href="new_student_tuition.htm" style="text-decoration: none"><b><font color="#808000"> 
								</font></b><font color="#808000"> 
								[參考更多資訊]</font></a></font><p style="margin-top: 0; margin-bottom: 0">　<p style="margin-top: 0; margin-bottom: 0">
								<font face="微軟正黑體" size="2">有興趣在出發前先將大部分學費透過銀行轉帳, 轉到你的 USC 
								學生帳戶嗎?&nbsp;
								<a href="http://fbs.usc.edu/depts/sfs/page/2109/wire-transfers/" style="text-decoration: none">
								<font color="#808000">點選查看</font></a>學校的銀行轉帳資料. <br>
								<br>
								(<font color="#FF0000">請留意</font>: 任何轉帳動作, 請皆務必提供您在USC使用的學生名字, 
								USC ID, 個人連絡資料等, 以確保學校能將該筆款項順利轉至您的個人帳戶)</font>
		                    </p>
	                    </div>	
	                </div>
	                    
	                <!-- Item 6 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">該帶多少錢?&nbsp;&nbsp; How much money to bring with you?</a></span>
	                    <div class="content">
		                    <p>
				                <font size="2" face="微軟正黑體">這個部份因人而異, 也跟你打算用何種方式處理第一學期的學費有關聯。<br>
				                <br>
				                一般來說, 銀行開戶是新生們到美國後一定會處理的幾件大事之一. 一但帳號有了, 就可以請家人將後續需要的金額轉入, 
								大約幾天後就會入帳 (時間長段可先詢問國內的銀行).&nbsp; 開戶後, 立刻就有 ATM 卡可以使用, 大約5天 - 
								1個禮拜, 你的個人支票就會印好, 在那之後你就可以多數以支票交易 (有些大面額的交易, 商家會跟你要求出示 picture 
								ID, 確定身分). </font></p>
								<p style="margin-top: 0; margin-bottom: 0">　</p>
				                <p style="margin-top: 0; margin-bottom: 0">
								<font face="微軟正黑體" size="2">如果是能在註冊繳費日大約2個禮拜 (或以上) 之前抵達LA的, 
								大概需要先帶的錢可以以下方項目預估:<br>
				                <br>
				                * 約2-3個月的租金 (這個以你自己打算找的房價來估): 一般房東在簽約時會要求要先繳第一個月房租及訂金<br>
				                * 約10天 ~ 2週的生活費 (僅供參考: 有在校生預估每個月約 500-600 多美金左右就夠過活, 還包括偶爾打牙祭)<br>
				                * 其他: 例如買些生活用品, 租屋處需要的一些基本家具或電器用品 (這也因而人而異, 請自行斟酌)<br>
				                <br>
				                如果赴美時間是已經離註冊日很近, 在不確定你的台灣匯款能否順利到達你的美國新帳戶的狀況下, 
								建議同學們就以大面額的旅行支票將需要的費用帶著. 時間來的及的話, 可以存入銀行帳戶, 到時候再開支票, 如果已來不及, 
								就可以直接以大面額旅行支票, 必要時配合使用信用卡, 直接支付學費等.&nbsp; </font>
								<p style="margin-top: 0; margin-bottom: 0">
								<font face="微軟正黑體" size="2">
								另一個處理方式是可以先將第一學期初估必須繳交的學雜費等先行從台灣的帳戶匯入你在 USC 
								的學生戶頭，此一戶頭並非銀行帳戶，而是所有的USC學生都有個個人帳戶，其中會記錄你在就學期間需繳交的各項費用及你以繳交的記錄等)。這個方式可避免隨身攜帶高額旅支。<br>
				                <br>
				                建議新生們在赴美前, 與義工學長姐們聯繫, 聽聽看不同的個人經驗, 應該會很有幫助!</font>
		                    </p>
	                    </div>
	                </div>						
					
					<!-- Item 7 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">學生醫療保險&nbsp;&nbsp;Student Medical Insurance</a></span>
	                    <div class="content">
		                    <p>
								<font size="2" face="微軟正黑體">學校要求所有學生在校期間，都一定要有 醫療保險。若您認為您在台灣已有</font><span lang="EN-US"><font size="3" face="新細明體"><span style="font-size:10.0pt;font-family:微軟正黑體;                       
								mso-ascii-font-family:Arial;mso-hansi-font-family:Arial;mso-bidi-font-family:                       
								Arial;color:black;mso-ansi-language:EN-US;mso-fareast-language:ZH-TW;                       
								mso-bidi-language:AR-SA">“足夠且適當”的保險，可以請保險公司開出英文證明，到校後辦理</span>
								<span style="font-size: 10.0pt; font-family: 微軟正黑體; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA; mso-fareast-font-family: 新細明體" lang="EN-US">
								waive</span><span style="font-size:10.0pt;font-family:微軟正黑體;mso-ascii-font-family:                          
								Arial;mso-hansi-font-family:Arial;mso-bidi-font-family:Arial;color:black;                          
								mso-ansi-language:EN-US;mso-fareast-language:ZH-TW;mso-bidi-language:AR-SA">。相關資料可參考</span><span style="font-size: 10.0pt; font-family: 微軟正黑體; mso-fareast-font-family: 新細明體; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA">                           
				            	admission office </span>
				                <span style="font-size:10.0pt;font-family:微軟正黑體;                           
								mso-ascii-font-family:Arial;mso-hansi-font-family:Arial;mso-bidi-font-family:                           
								Arial;color:black;mso-ansi-language:EN-US;mso-fareast-language:ZH-TW;                           
								mso-bidi-language:AR-SA">發出給新生的</span><span style="font-size: 10.0pt; font-family: 微軟正黑體; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial" lang="EN-US">                          
				            	</span>
								<span lang="EN-US" style="font-size:10.0pt;                         
								font-family:微軟正黑體;mso-fareast-font-family:新細明體;color:black;mso-ansi-language:                         
								EN-US;mso-fareast-language:ZH-TW;mso-bidi-language:AR-SA">admission package!<span style="mso-spacerun: yes">&nbsp;                            
				            	</span></span>
				                <span style="font-size:10.0pt;                           
								font-family:微軟正黑體;mso-ascii-font-family:Arial;mso-hansi-font-family:Arial;                           
								mso-bidi-font-family:Arial;color:black;mso-ansi-language:EN-US;mso-fareast-language:                           
								ZH-TW;mso-bidi-language:AR-SA">您也可以向</span><span lang="EN-US" style="font-size:                          
								10.0pt;font-family:微軟正黑體;mso-fareast-font-family:新細明體;color:black;mso-ansi-language:                          
								EN-US;mso-fareast-language:ZH-TW;mso-bidi-language:AR-SA"> TSA </span>
								                <span style="font-size:10.0pt;font-family:微軟正黑體;mso-ascii-font-family:Arial;                           
								mso-hansi-font-family:Arial;mso-bidi-font-family:Arial;color:black;mso-ansi-language:                           
								EN-US;mso-fareast-language:ZH-TW;mso-bidi-language:AR-SA">學長姐或義工學長姐詢問。<br>
				                <br>
				                目前學校有提供學生醫療保險, 平時可以直接在學校的醫療系統內看病, 必須到外面看診時也是 OK.&nbsp;</span></font></span>
		                    </p>
	                    </div>
	         		</div>	
	         		
					<!-- Item 8 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">學校周邊旅館資訊&nbsp;&nbsp;Temporary Accommodations Near Campus</a></span>
	                    <div class="content">
		                    <p>
								<span style="font-family: 新細明體; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA" lang="EN-US">
				                <font face="微軟正黑體" size="2">學校附近, 走路可到的距離內, 以及學校北方約車程5-10分鐘距離的 
								LA Downtown, 都有一些可以短暫居住的<a href="new_student_hotels.htm" style="text-decoration: none"><font color="#808000">飯店或旅館</font></a>, 
								價位不一, 可參考看看.&nbsp; 尤其是如果有父母親要陪同前往的, 可以參考看看.</font></span>
		                    </p>
	                    </div>
	         		</div>			
	         		
					<!-- Item 9 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">開戶&nbsp;&nbsp;&nbsp;&nbsp; Open a Bank Account</a></span>
	                    <div class="content">
		                    <p>
				                <font size="2" face="微軟正黑體">
				                <span style="mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA" lang="EN-US">
				                開戶的相關細節, 可以參考<a href="new_student_experience_sharing.htm" style="text-decoration: none"><font color="#808000">前輩的經驗</font></a>.&nbsp; 
								學校附近有多家銀行, 例如: 學校北邊的 University Village 裏有包括美國銀行 (Bank of 
								America, BOA), Wells Fargo 等大小銀行。外國學生開戶</span><font color="#FF0000"><span style="mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA" lang="EN-US">不需要社會福利號碼</span></font></font><span lang="en-us"><font size="2" face="微軟正黑體">, 
								學校 ID number, 護照等就可以.</font></span>
		                    </p>
	                    </div>
	         		</div>	
					
					<!-- Item 10 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">考駕照 &amp; 國際駕照&nbsp;&nbsp;&nbsp; Getting a 
								Driver's License &amp; International Driver License</a></span>
	                    <div class="content">
		                    <p>
								<font face="微軟正黑體" size="2">據有經驗的同學表示, 留學生還是最好考加州的駕照, 一方面也可當作個人的 
								picture ID.&nbsp; </font>
								</p>
								<p style="margin-top: 0; margin-bottom: 0"><span lang="en-us">
								<font face="微軟正黑體" size="2">(註: 過往曾有學校人員表示國際學生可使用自己國家發出的駕照, 
								但此一說法應該已不甚恰當. 安全起見, 建議有興趣開車的同學還是最好取得當地駕照!)</font></span></p>
								<p style="margin-top: 0; margin-bottom: 0">　</p>
								<p style="margin-top: 0; margin-bottom: 0"><span lang="en-us">
								<font face="微軟正黑體" size="2">打算考駕照的人 - 不需有社會福利卡, 
								只需攜帶有效的I-20及護照即可辦理.</font></span><span lang="EN-US" style="mso-fareast-font-family:華康POP1體W5"><font size="2" face="微軟正黑體"><br>
				                <br>
				                另外, 有同學提供了 &quot;<a href="new_student_DL.htm" style="text-decoration: none"><font color="#808000">如何申請考照&quot; </font>
								<font color="#000000">的訊息</font></a>. 同時, 一些針對外籍人士在美國生活的網站, 
								也有針對這個部份做些蠻詳細的說明, 同學們也可以多家參考. 右方是其中之一<font color="#808000">: </font>
				                </font></span><font face="微軟正黑體" size="2">
				                <a href="http://www.caldrive.com/law.html" style="text-decoration: none">
				                <font color="#808000">http://www.caldrive.com/law.html</font></a><br>
				                </font>
				                <span lang="EN-US" style="mso-fareast-font-family:華康POP1體W5">
								<font size="2" face="微軟正黑體">
				                <br>
				                </font></span>
				                <span style="mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA" lang="EN-US">
				                <font size="2" face="微軟正黑體">加州駕照，先筆試再路考。筆試有<a href="http://www.chineseypage.com/dmv/dmv.htm" style="text-decoration: none"><font color="#808000">中文考古題</font></a>可參考。</font></span>
		                    </p>
	                    </div>
	         		</div>
	         		
					<!-- Item 11 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">有關學生證&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; About Student ID Card (USCard)</a></span>
	                    <div class="content">
		                    <p>
				                <font face="微軟正黑體" size="2">新生在赴美前即會收到指示, 可將個人照片先上傳到指定網站.&nbsp; 
								開學時可直接領取學生證.&nbsp; (若因故無法上傳照片, 到校後還是可以辦理)</font></p>
								<p style="margin-top: 0; margin-bottom: 0">　</p>
								<p style="margin-top: 0; margin-bottom: 0">
								<font face="微軟正黑體" size="2">如果是暑假期間先到 USC Language Academy 
								唸英語的同學, 課程開始第一天的 orientation 就會拿到 USC ID card.&nbsp; 
								這個學生證可以讓你進出所有校內學生可以使用的場地, 包括圖書館, 電腦室, 健身中心 .... 等等.&nbsp; 
								待完成語言中心課程之後, 學校就會將你的紀錄更新為 [正式學位課程學生], 你不必再重新申請一張新的 ID card.&nbsp;
				                <b>&nbsp;&nbsp;
								</b>
								<a href="new_student_USCard.htm" style="text-decoration: none">
								<font color="#808000">[更多有關 USCard 資訊及經驗分享]</font></a></font>
		                    </p>
	                    </div>
	         		</div>		         		
	         		
					<!-- Item 12 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">開學前的英語測試&nbsp;&nbsp;&nbsp;&nbsp; ISE test</a></span>
	                    <div class="content">
		                    <p>
								<font color="#FF0000">除了部份一年制的碩士課程之外</font>, 如果你的托福沒有達到下方成績, 
								開學前就都得參加英語測試, 以評估你還需要再加強哪些部份.&nbsp; (註: 部分學院或研究所採用較高標準托福成績, 請<font face="微軟正黑體" size="2">依您收到的 
								admission letter 內容為主)</font></p>
								<p style="margin-top: 0; margin-bottom: 0">
				                　</p>
								<p style="margin-top: 0; margin-bottom: 0" align="left">
				                <font face="微軟正黑體" size="2">碩士&nbsp; 90 分&nbsp;&nbsp; &amp;&nbsp;&nbsp; 
								博士&nbsp; 100 分 (此二者皆需所有的分項成績皆 20 分或更高)</font></p>
								<p style="margin-top: 0; margin-bottom: 0">
				                　</p>
								<p style="margin-top: 0; margin-bottom: 0">
				                <span lang="en-us"><font face="微軟正黑體" size="2">
								相關的考試日期, 場地, 攜帶文件, 考試內容等, 請自行查詢<a href="http://www.usc.edu/dept/LAS/ALI/ISE.html" style="text-decoration: none"><font color="#808000">學校測試中心</font></a>的網站. 
								由於測試之後得修的英文課都是以學分費計算, 如果情況允許, 強烈建議同學們在開學前盡量隨時加強自己的英語能力.&nbsp; </font></span>
								</p>
								<p style="margin-top: 0; margin-bottom: 0">
				                　</p>
								<p style="margin-top: 0; margin-bottom: 0">
								<font face="微軟正黑體" size="2">考試日期 - 暑假期間請留意負責的測試單位, ALI, 的網站資訊.&nbsp; 
								一般 ALI 都會先公佈一個較早的測試日期 (例如 8 月初), 後續ALI會視情況再另行公布其他日期.&nbsp; 
								建議同學盡量參加既定的測試行程, 以避免影響選課等.</font>
		                    </p>
	                    </div>
	         		</div>	
	
					<!-- Item 13 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">如果有子女同行的話&nbsp;&nbsp;Students with Kids</a></span>
	                    <div class="content">
		                    <p>
				                <font size="2" face="微軟正黑體">
								有些同學可能會有學齡子女同行。據學校相關主管表示，如果孩子是因為陪同父母就學而到美國 (用F-2 
								簽證)，那他們就讀當地公立學校時不會被要求繳交學費。不過如果主因是因為要到美國去就學，那就會被要求繳付學費。<br>       
				            	<br>       
				            	另外，據一些有經驗的前輩表示孩子入學時，要繳交相關文件包括：<br>       
				            	</font><font size="2" face="新細明體"><span style="font-family: 微軟正黑體; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial; color: black; mso-ansi-language: EN-US; mso-fareast-language: ZH-TW; mso-bidi-language: AR-SA"><br>    
				            	＊可以證明您是居住在當地的各類帳單，例如水電，瓦斯，房租等等<br>
				            	＊孩子在台灣就學的成績單 (用來參考學生已在台灣就學多少年)<br>       
				            	＊Yellow (Health) card 顯示已接受過哪些疫苗接種<br>       
				            	<br>       
				            	您可參考看看。有關加州地區小學部分的相關資料，可參考        
				            	<a href="http://www.ed-data.k12.ca.us/">
								http://www.ed-data.k12.ca.us/</a></span></font>
		                    </p>
	                    </div>
	         		</div>
	         		
				</div> <!-- End of section -->
				
				
				<!-- Experience Sharing -->
				<div class="section">
					<h1>Experience Sharing</h1>
					<p>
						在你開始聯絡其他學長姐,&nbsp;詢問各種你關心的問題之前,&nbsp;有些寶貴的前人經驗,&nbsp;與你分享一下&nbsp;
						讓赴美之旅更順暢﹗除了截至目前為止,&nbsp;多位新生們針對大家憂心的議題提供個人經驗與心得外,&nbsp;
						下方辦事處也集結了一些重點供大家參考!!
					</p>					
					
	                <!-- TIP 1 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 1.&nbsp;&nbsp;&nbsp;盡量在出國前結識其他新生，並找人同行。</a></span>
	                    <div class="content">
		                    <p>
		            			暑假期間原本校園內的學長姐人數就不多了，以每年夏天約100多位新生來自台灣的數量而言，如果要全部都等到了LA 
								之後再尋求前輩幫忙，有時可能難盡如人意。先在台灣與其他新生認識，可以到時候一起探險、闖天下，至少壯膽也好。
								如果無法挪在同一天赴美，可以先約定日後的連絡方式，“先來的”可以幫助“後到的”。
		                    </p>
	                    </div>
	         		</div>
				
	                <!-- TIP 2 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 2.&nbsp;&nbsp;&nbsp;如果不會開車、或是希望在學校附近找房子，盡量提早出國。</a></span>
	                    <div class="content">
		                    <p>
								學校周邊的房子跟國內一樣，需求大過供給。如果你完全不會開車，一定得住在學校周邊，或是不打算買車，那強烈建議你儘早出國。多早？沒有百分之百正確的答案，但據了解難度已愈來愈高，
								所以要不就是做好心理準備買車，開車上下課，要不較早早去，把房子敲定後，再到各處玩玩或上英文課。另外，洛杉磯的公車系統相當不發達，與台灣的大都市非常非常不同，
								所以不要誤會你可以方便的搭“捷運”或“公車”上課。（除非你是住在LA downtown area 才比較有可能搭公車上課)。Downtown 距學校開車約是 5 分鐘。
								<font color="#800000">自2003秋季班起，美國政府規定外籍新生只能在開學前1個月入境美國，因此來自各國的外籍學生都會在差不多時間抵達並尋找住處，先祝大家好運。</font>
		                    </p>
	                    </div>
	         		</div>
	         		
	                <!-- TIP 3 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 3.&nbsp;&nbsp;&nbsp;儘早加強英文能力。</a></span>
	                    <div class="content">
		                    <p>
								凡是沒有交托福成績、或托福沒有過 (碩士生)&nbsp; IBT 90 或 (博士生) IBT 100&nbsp;(每單項必須20或以上) 
								的非英語系外籍學生，開學前都得參加英語測試。這個測試將決定你的英文程度距離在美讀書應有的實力還差距多遠，以及你還得如何修多少英文課。
								這種測試之後的英文課就是以“學分費”計算，因此強力建議托福成績尚未到達上述分數的新生在入學前，努力加強自己的英文能力，不論是到 USC 
								的語言中心上課、到別的美國言語中心、或是在台灣加強，都可以。 
								(學校語言中心暑期開課的非學分課程，費用較低，有興趣提早赴美進修英文的同學可以參考）只要你能在開學前交出托福 IBT 100 
								或以上的成績, 就可以不必再考入學前的英語測試。 
		                    </p>
	                    </div>
	         		</div>
	         		
	                <!-- TIP 4 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 4.&nbsp;&nbsp;&nbsp;租屋相關簽約要小心。</a></span>
	                    <div class="content">
		                    <p>
								在美國（其實台灣也一樣），簽約是個要非常小心處理的事。一定要先仔細看過合約內容才能簽名。有些房子租屋時需要 
								co-signer，要記得問清楚萬一要改變心意的話，幾天之內可以退約，會扣多少錢。千萬不要什麼都不了解的狀況下就胡亂簽。
								不清楚的項目, 建議跟 OIS 的顧問們詢問看看!
		                    </p>
	                    </div>
	         		</div>
	         		
	                <!-- TIP 5 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 5.&nbsp;&nbsp;&nbsp;電話帳單的細目要記得核對。</a></span>
	                    <div class="content">
		                    <p>
								美國的電話公司競爭激烈，各家都有各種五花八門的方案供選擇。記得先瀏覽電話公司提供的介紹，選定自己需要的功能項目後，再去提出申請。
								帳單來了之後，也要記得核對帳單，看看扣款的項目是否和當初自己選的功能是符合的。帳單出問題的狀況多少都有發生過。
		                    </p>
	                    </div>
	         		</div>
	
	                <!-- TIP 6 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 6.&nbsp;&nbsp;&nbsp;學校停車證儘早購買。</a></span>
	                    <div class="content">
		                    <p>
								學校周邊的停車位很不好找，計劃買車並住在外地的人，最好儘早向學校相關單位購買停車證。停車證也要依指示貼好，否則會拿到罰單。另外，學校外圍北邊的 
								UV (University Village) 是很多學生會去買東西吃或買雜貨的地方，UV的停車位僅供購物者使用，如果學生將車子停了就到校上課，被UV逮到時，也是會罰款 
								(據說美金35元)。查詢更多與學校 parking 或學校校車 tram 的相關資料。     
				            	另外也有學生建議，萬一申請不到學校的停車證，可以試試學校正北邊 Jefferson Blvd. 的 The Shrine 
								Auditorium (原奧斯卡舉辦地點)，據說多數時候可以購得校外停車證。
		                    </p>
	                    </div>
	         		</div>         		
	         		
	                <!-- TIP 7 -->
	                <div class="acc-container">
	                	<span class="acc-trigger"><a href="#" onClick="return false;">TIP 7.&nbsp;&nbsp;&nbsp; 積極主動、善加使用南加大人人際資源。</a></span>
	                    <div class="content">
		                    <p>
								南加大非常重視校友關係，也透過學校在亞洲的海外辦事處與各地校友建立起一個綿密的海外南加大人網路，這些都是學生們可以多多參與, 
								並加以拓展個人network的重要資產。若個人聯絡資料或是email有更動，請記得隨時向台北辦事處更新，以利收到相關的各種訊息。
		                    </p>
	                    </div>
	         		</div>
				</div>				
				
				
				<!-- Useful Websites -->
				<div class="section">
					<h1>Useful Websites</h1>
					<ul>
						<li><a href="http://www.usc.edu/student-affairs/OIS/" target="_blank">Office of International Services</a></li>
						
						<li><a href="http://itservices.usc.edu" target="_blank">Information Technology Services</a></li>
						
						<li><a href="http://dornsife.usc.edu/ali/" target="_blank">American Language Institute</a></li>
						
						<li><a href="http://transportation.usc.edu" target="_blank">USC Transportation</a></li>
						
						<li><a href="http://web-app.usc.edu/maps/" target="_blank">USC Maps</a></li>
						
						<li><a href="http://dailytrojan.com/" target="_blank">Daily Trojan</a></li>
					
						<li><a href="http://scampus.usc.edu/" target="_blank">SCampus</a></li>
					</ul>
				</div>
				
				
			</div><!-- [END] #main -->
			
			
            <!-- footer -->
            <footer>
                <div class="footer">
                    <p>
                    	<?=fuel_var('page_footer')?>
                    </p>
                </div>
            </footer>			
			
		</div><!-- [END] #wrapper -->
	</body>
</html>