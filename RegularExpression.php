<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> RegularExpression Test </TITLE>
<script src="./js/jquery-1.9.1.js"></script>
<script lang="javascript">
    
</script>
</HEAD>
<BODY>
<?php
$i=1;
/*
 ────────────────────────────────────────────────────────
  메타문자      설명
 ────────────────────────────────────────────────────────
	\d            숫자 하나 ([0-9]와 같다)
	\D            숫자를 제외한 문자 하나 ([^0-9]와 같다)
 ─────────────────────────────────────────────────────────
	\w            대소문자와 밑줄을 포함하는 모든 영숫자([a-zA-Z0-9_]와 같다)
	\W           영숫자나, 밑줄이 아닌 모든 문자([^a-zA-Z0-9_]와 같다)
 ─────────────────────────────────────────────────────────
	\s            모든 공백 문자 ([\f\n\r\t\v]와 같다)
	\S           공백 문자가 아닌 모든 문자 ([^\f\n\r\t\v]와 같다)
 ─────────────────────────────────────────────────────────
 \f  페이지 넘김
 \n  줄바꿈
 \r  캐리지 리턴(현재 위치를 나타내는 커서를 맨 앞으로 이동시킨다.)
 \t  탭
 \v  수직탭
*/
$strVar1="
Hello, my name is Ben. please visit
my website at http://www.forta.com/ Ben..
";
$pattern1 = "/Ben/";


/////////////////////////////////////////////////////////////////////////////////////

$strVar2="
The URL is http://www.forta.com/, to connect
securely use https://www.forta.com/ instead.
";
$pattern2 = "/https?:\/\/[\w.\/]+/";


/////////////////////////////////////////////////////////////////////////////////////
/*
 우리가 원하는 텍스트를 포함하긴 하지만, 찾으려하지 앟은 텍스트도 포함했다.
 바로 별표(*)와 더하기(+) 같은 메타 문자가 탐욕적이기 때문인데,
 이는 가능한 한 가장 큰 덩어리를 찾으려 한다는 뜻이다.
 이런 메타 문자는 찾으려는 텍스트를 앞에서부터 찾는 게 아니라, 
 텍스트 마지막에서 시작해 거꾸로 찾는다. 
 이는 의도적으로 수량자(quantifier)를 탐욕적으로 설계했기 때문이다.

 하지만 만약 우리가 탐욕적 일치를 원하지 앟는다면 어떻게 해야 할까?
 탐욕적 수량자를 게으른(lazy) 수량자로 바꿔 이 문제를 해결한다.
 '게으른'이라고 부르는 이유는 문자가 최소로 일치하기 때문이다.
 게으른 수량자는 기존 수량자 뒤에 물음표(?)를 붙여서 표현하다.
 ───────────────────────────────────────
          타욕적 수량자                    게으른 수량자
 ───────────────────────────────────────
            *                                          *?
		    +                                          +?
		  {n,}                                       {n,}?
 ────────────────────────────────────────
 *?는 별표(*)의 게으른 버전인데, 이 문자를 이용해 앞서 나오 예제를
 수정해 보자
*/
$strVar3="
This offer is not available to customers
living in <B>AK</B> and <B>HI</B>.
";
$pattern3 = "/<[Bb]>.*<\/[Bb]>/";
$pattern3_ = "/<[Bb]>.*?<\/[Bb]>/";


/////////////////////////////////////////////////////////////////////////////////////
/*
  단어의 경계 지정하기
  cat 패턴은  cat이 있는 부분과 모두 일치한다. csattered라는 단어 사이에 cat과도
  일치한다. 이럴 때  경계(boundaries)를 사용하거나 패턴 앞이나 뒤에 특정한
  위치 혹은 경계를 나타내는 메타 문자를 사용해야 한다.
  가장 흔하게 쓰는 방법인데, \b로 표시하는 단어 경계다.
  \b는 무엇일까? 일반적으로 단어의 일부를 사용하는 문자(\w와 일치하는 문자)와
  그외 문자(/W와 일치하는 문자) 사이에 있는 위치와 일치한다.
  그리고 중요한점은 /b는 문자와 일치하는 것이 아니고 위치를 가리킨다.
  즉 아래 문자는 5(\bcat\b)개가 일치하는게 아니라 3(cat)개가 일치한다.
  /B는 /b의 반대이다. 
 */
$strVar4="
The cat scattered his food all over the room.
";
$pattern4 = "/cat/";
$pattern4_ = "/\bcat\b/";  // the <cat> 찾음
$pattern4__ = "/\Bcat\B/";  // the cat s<cat>tered 찾음


$strVar5="
The  captain wore this cap and cape proudly as he sat listening to the 
recap of how his crew saved the men from a capsized vessel.
";
$pattern5 = "/\bcap/";
$pattern5_ = "/cap\b/";


/////////////////////////////////////////////////////////////////////////////////////
/*
  다중행 모드 사용하기
  대개 캐럿(^)은 문자열이 시작과 일치하고, 달러($)는 문자열의 마지막과 일치한다.
  예외적으로 두 메타 문자의 동작을 바꾸는 방법이 있다. 많은 정규표현식 구현은 다른 메타 문자의 
  동작을 변경하는 특수한 메타 문자를 지원하는데, 그 중 하나가 (?m)으로, 다중행(multiline)을 지원한다.
  다중행 모드로 변경하려면 강제로 정규 표현식 엔진이 줄바꿈 문자를 문자열 구분자로 인식한다.
  캐럿(^)은 문자열의 시작이나 줄바꿈 다음(새로운 행)에 나오는 문자열의 시작과 일치하고, 달러($)는 
  문자열의 마지막이나 줄바꿈 다음에 나오는 문자열의 마지막과 일치한다. (?m)은 항상 패턴 제일 앞에
  두어야 한다. 위에 예제를 보면 코드 블럭 안에 있는 자바스크립트 주석을 모두 찾는 데 정규 표현식을 
  사용했다.
  만약 (?m)를 빼면 맨 처음 주석줄인 // make sure not empty 만 찾게 되는데 여기서는 아예 못 찾는다.
 */
$strVar6="
function test(){
	// make sure not empty
	if(field.value == ''){
		return false;
	}

	// Init
	var windowName='spellWindow';
	var spellcheckurl='spell.cfm?formname=comment';
	...
	// Done
	return false;
}
";

$pattern6 = "/(?m)^\s*\/\/.*$/";
$pattern6_ = "/^\s*\/\/.*$/";


/////////////////////////////////////////////////////////////////////////////////////
/*
  중첩된 하위 표현식
 */
$strVar7="
pinging hog.forta.com [12.159.46.200]
with 32 bytes of data:
";

$pattern7 = "/(((\d{1,2})|(1\d{2})|(2[0-4]\d)|(25[0-5]))\.){3}((\d{1,2})|(1\d{2})|(2[0-4]\d)|(25[0-5]))/"; // 12.159.46.200


/////////////////////////////////////////////////////////////////////////////////////
/*
역참조로 찾기
여기서 마지막 부분에 <h2>로 시작해서 </h3>로 끝나는 문장 부분을 제외 시키려면..
 */
$strVar8="
<body>
<h1> welcome to my hompage</h1>
content is divided into two sections<br>
<h2> conldfusion</h2>
information about macromedia coldfusion.
<h2> wireless</h2>
<h2>this is not valid html</h3>
</body>
";
$pattern8 = "/<[Hh][1-6]>.*?<\/[Hh][1-6]>/";
$pattern8_ = "/<[Hh]([1-6])>.*?<\/[Hh]\\1>/"; // \1(기본), \\1(php), $1(펄) 언어에 따라서 역참조 형식은 틀려질수 있다. 


/////////////////////////////////////////////////////////////////////////////////////
/*
전방탐색
지금까지는 일치하는 텍스트를 가지고 있었지만, 가끔은 텍스트 자체를 찾기보다는 어디서 텍스트를 
찾을지를 표시하는 데 표현식을 쓰고 싶을 때도 있다.
전방탐색(lookahead) 패턴은 일치 영역을 발견해도 그 값을 반환하지 않는 패턴을 말한다.
전방탐색은 실제로는 하위표현식이며, 하위표현식과 같은 형식으로 작성한다.
+패턴은 모든 텍스트와 일치하고 하위표현식(?=:)은 콜론(:)과 일치한다. 그런데 여기서 콜론(:)은
일치하지 않은 것으로 나타남을 눈여겨봐야 한다.
?=는 정규 표현식 엔진에게 콜론(:)을 찾되 콜론(:) 앞에 있는 문자를 찾으라고 지시한다.

*정규식에서 문자에서 일치하는 영역을 반환하는 동작을 표현할때 '소비한다(consume)'라는 용어를 쓴다.
  이럴 경우 정방탐색은 '소비하지 않는다(not consume)'고 말한다.
 */
$strVar9="
http://www.forta.com/
https://mail.forta.com/
ftp://ftp.forta.com/
";
$pattern9 = "/.+(?=:)/";
$pattern9_ = "/.+(:)/";  // 위와 더 잘 비교할 수 있다.



/////////////////////////////////////////////////////////////////////////////////////
/*
후방탐색
후방탐색 연산은 ?<= 이다.

 ────────────────────────────────────────────────────────
     종류      설명
 ────────────────────────────────────────────────────────
     (?=)        긍정형 전방탐색
     (?!)         부정형 전방탐색
     (?<=)       긍정형 후방탐색
     (?<!)        부정형 후방탐색
 ─────────────────────────────────────────────────────────
 */
$strVar10="
abc01: $23.45
hgg42: $5.31
cfmx1: $899.00
xtc99: $69.96
total items found: 4
";
$pattern10 = "/[$][0-9.]+/";  // 원래는 \$[0-9.]+ 가 되야하는데 $특수문자가 검색이 안되서 []연산자를 씀
$pattern10 = "/(?<=[$])[0-9.]+/";


$strVar11="
<head>
<title>ben forta's homepage</title>
</head>
";
$pattern11= "/(?<=<title>).*(?=<\/title>)/";  // 전후방 탐색하기


$strVar12="
I paid $30 form 100 apples,
50 oranges, and 60 pears.
i saved $5 on This order.
";
$pattern12= "/(?<=[$])\d+/";   // 가격을 찾는다.
$pattern12_= "/(?<![$])\d+/";   // 수량을 찾는다. 그런데 문제가 있다..
$pattern12_= "/\b(?<![$])\d+\b/";   // 수량을 찾는다. 깔끔하다. 단어경계가 필요하다.

/////////////////////////////////////////////////////////////////////////////////////
/*
역참조를 사용하는 조건 처리
이전 하위 표현식이 검색에 성공했을 경우에만 다시 그 표현식을 검사한다.
(?(앞에검색된 하위표현식이 있다면) 검사한다)
(?(앞에검색된 하위표현식이 없다면) 통과한다)
(?(앞에검색된 하위표현식이) true-있으니 검사한다 | false-없으니 통과한다)
 */

$strVar13="
123-456-7890
(123)456-7890
(123)-456-7890
(123-456-7890
1234567890
123 456 7890
";
$pattern13 = "/\(?\d{3}\)?-?\d{3}-\d{4}/"; // 올바른 전화 번화 찾기 하지만 (123-456-7890 도 검색된다.
$pattern13_ = "/(\()?\d{3}(?(1)\))-?\d{3}-\d{4}/"; 
$pattern13__ = "/(\()?\d{3}(?(1)\)|-)\d{3}-\d{4}/"; 

$strVar14="
<table>
<tr><td>
<a href='/home'><img src='/images/a.gif'></a>
<img src='/images/b.gif'>
<a href='/search'><img src='/images/search.gif'></a>
<img src='/images/c.gif'>
<a href='/help'><img src='/images/help.gif'></a>
</td></tr>
</table>
";
$pattern14 = "/(<a\s+[^>]+>\s*)?<img\s+[^>]+>(?(1)\s*<\/[a]>)/"; // <a> 태그 안에 이미지와 그냥 이미지태그 둘다 찾는다. 
$pattern14_ = "/(<a\s+[^>]+>\s*)?<img\s+[^>]+>(\s*<\/[a]>)/";  // <a > 태그 안 이미지만 찾는다.


$strVar15="
11111
22222
33333-
44444-4444
";
$pattern15 = "/\d{5}(?(?=-)-\d{4})/";
/*
\d{5}는 앞부분에 있는 다섯 자리 숫자와 일치한다. 
그리고 나서 (?(?=-) 같은 전방탐색 하여 하이픈이 있다는 조건이 나타나면 
-\d{4}을 검색한다. 
검색해서 네 개의 숫자가 이어지지 않으면 만족하지 않는 검색.
*/
/////////////////////////////////////////////////////////////////////////////////////


$strVar16="angel.jpg?type=f10060";
$strVar16="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRO9XPUdgeentSkrT4O7GMKS3OpVFmqlpOhs6hK1Zs_RafR_6F8Ag";
$pattern16 = "/^(.+)\.([a-zA-Z]+)\??.*$/";
/////////////////////////////////////////////////////////////////////////////////////


$strVar17="
2013-07-09 아이티투데이 성상훈기자 HNSH@ittoday.co.kr 
http://www.ittoday.co.kr/news/articleView.html?idxno=37761 


%130709_01.jpg% 

국내 최초로 창업과 투자펀드가 연계된 이스라엘식 창업센터가 판교테크노밸리에 들어섰다. 
성남투썬특성화창업센터는 판교 V포럼빌딩에 지원공간을 마련하고, 9일 개소식과 함께 본격적인 운영에 들어갔다. 
기존의 창업보육센터의 경우 자금지원기관과 유기적인 협력이 이뤄지지 않은 것이 사실이다. 성남투썬특성화창업센터는 투썬인베스트, 한국벤처투자, 연기금이 200억원 규모의 인큐베이팅 펀드를 조성해 초기 창업기업을 발굴하고 투자한다. 
센터를 공동운영하는 성남산업진흥재단은 창업→투자→성장→재투자의 선순환 구조를 확립해 판교테크노밸리를 활성화하고 지역경제 역동성을 살리기 위한 창업혁신도시를 추구할 것이라고 설명했다. 

%130709_02.jpg% 

재단측에 따르면 향후 5년간 성남투썬특성화창업센터 운영을 통해 매출 1500억원, 일자리 300여개가 창출될 것으로 예상되고 있다. 
센터 운영위원회 심사를 거쳐 1단계로 11개 창업기업이 성남투썬특성화창업센터에 입주했으며, 현재까지 99억원이 지원된 상태다. 
현재 입주기업은 ㈜메인탑, ㈜리싸이콜, ㈜알펜인터내셔날, 스튜디오나인㈜, ㈜판크리스탈, 케이컬처㈜, 브이플랩㈜, ㈜에이치앤제이인터내셔널, ㈜투썬링클, ㈜모라코, ㈜투썬이엔에스 등이며 향후 3개 기업이 추가 선정될 예정이다. 
업체당 지원금은 1억원~15억원으로, 이는 지난해 전국 벤처캐피탈 벤처기업 평균 지원금 1억4000만원보다 여섯 배 이상 많은 규모다. 
이재명 성남시장은 이날 \"성남투썬특성화창업센터에 입주한 모든 기업이 다 같이 큰 회사로 성장하길 기원한다\"며 \"오늘 입주한 기업들은 향후 성공적인 기업을 이루게 되면 투자받은 금액 이상을 벤처 육성에 지원해주길 바란다\"고 당부했다. 

%130709_03.jpg%
";
$pattern17 = "/%([^ .]+)?\.(jpg|gif|png)?%{1}?/i";
/////////////////////////////////////////////////////////////////////////////////////


$strVar18="./img/picture/pns/image/cssht_13.png";
$pattern18 = "/(.+\/)(.+)\.(jpeg|jpg|png)?$/i";
/////////////////////////////////////////////////////////////////////////////////////


$strVar19="https://www.nddd.com/eisldi8fllefke/";
$strVar19="https://www.nddd.com/eisldi8fllefke/sfdfsadf";
$strVar19="http://www.nddd.co.kr/eisldi8fllefke/";
$strVar191="fdksadf.jkflsdajf.nddd.com/eisldi8fllefke/";
$strVar191="nddd.com/eisldi8fllefke/dfsafd";
$strVar191="nddd.co.kr";
//$pattern19 = "/^(http[s]?:\/\/)?([a-zA-Z0-9]*)?\.?(.[^\/]+)?\/?(.*)/i";
//$pattern19 = "/^(http[s]?:\/\/)?([a-zA-Z0-9]*)?\.{0,1}(.+)?\.([a-zA-Z]+)?\/{0,1}(.*)$/i";
$pattern19="/(?:(?:(https?|ftp|telnet):\/\/|[\s\t\r\n\[\]\`\<\>\"\'])((?:[\w$\-_\.+!*\'\(\),]|%[0-9a-f][0-9a-f])*\:(?:[\w$\-_\.+!*\'\(\),;\?&=]|%[0-9a-f][0-9a-f])+\@)?(?:((?:(?:[a-z0-9\-가-힣]+\.)+[a-z0-9\-]{2,})|(?:[\d]{1,3}\.){3}[\d]{1,3})|localhost)(?:\:([0-9]+))?((?:\/(?:[\w$\-_\.+!*\'\(\),;:@&=ㄱ-ㅎㅏ-ㅣ가-힣]|%[0-9a-f][0-9a-f])+)*)(?:\/([^\s\/\?\.:<>|#]*(?:\.[^\s\/\?:<>|#]+)*))?(\/?[\?;](?:[a-z0-9\-]+(?:=[^\s:&<>]*)?\&)*[a-z0-9\-]+(?:=[^\s:&<>]*)?)?(#[\w\-]+)?)/";
/////////////////////////////////////////////////////////////////////////////////////

// html 주석 찾기
// .*? 게으른 수량자 사용
$strVar20="
<!-- start of page -->
<html>
<!-- head -->
<head><title> my title</title></head>
<!-- body -->
<body>
";
$pattern20="/<!--{2,}.*?--{2,}>/";
/////////////////////////////////////////////////////////////////////////////////////

// 완전한 url
$strVar21="
http://www.forta.com/blog
https://www.forta.com:80/blog/index.cfm
http://www.forta.com
http://ben:password@www.forta.com/
http://localhost/index.php?ab=1&b=2
";
$pattern21="/https?:\/\/(\w*:\w*@)?[-\w.]+(:\d+)?(\/([\w/_.]*(\?\S+)?)?)?/";
/* 위에 패턴을 분석하기 좋게 분해
https?
:\/\/
(\w*:\w*@)?
[-\w.]+
(:\d+)?
(
	\/
	  (
		[\w/_.]*
		(
			\?\S+
		)?
	)?
)?
*/
/////////////////////////////////////////////////////////////////////////////////////





$strVar="http://4.bp.blogspot.com/-HUEUa-2-jXc/UK9yHxF0R2I/AAAAAAABSvA/C_W2bVssgLM/s1600/Dewi%2BFashion%2BKnights%2BRunway%2BShow%2BJakarta%2BFashion%2BWeek_0250.JPG";
$pattern="/^(.+)\.([a-zA-Z]+)\??.*$/";
$strVar="safljasfdsda, 12,3656jflas65_546, dfasfd6dfs,9898,55445,4545,ㅓ림너가넝@#@$%  ,687,646546,6475 , ko";
$pattern = "/[^0-9, ]+ *,*| *, *[^0-9, ]+/";

//$strVar = preg_replace($pattern,"", $strVar);
//$strVar = preg_replace($pattern,"<img src='./gnuboard4/data/file/$1.$2'>", $strVar);
//$rs = preg_match_all($pattern, $strVar, $matches);

/*
$strVar="http://175.118.124.174:8080/pns_storage_usa/app_1400487784807152.jpg";
$pattern="/(.+\/)(.+)\.(jpeg|jpg|png)?$/i";
$rs = preg_match($pattern, $strVar, $matches);



pp($strVar);
pp($matches[1]);
pp($matches[2]);
pp($rs);
pr($matches);
pp(count($matches));
*/

$strVar="12abcde98ABCD34fghij76EFGH56klmno54pppp888888asfdasfdsafdaf88888";
$pattern="/((.{2})(.{5})(.{2})(.{4})){3}/s";
$rs = preg_match($pattern, $strVar, $matches);
pr($matches);


function pp($s) {
	global $i;
	echo "<br />\n----------------------------------\n<br />";
	echo "$i : $s";
	echo "<br />\n----------------------------------\n<br />";	
	++$i;
}

function pr($s) {
	echo "<span><pre>";
	print_r($s);
	echo"</pre></span>";
}
?>
</BODY>
</HTML>