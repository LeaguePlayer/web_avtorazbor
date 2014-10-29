<form name="sub" method="post">
<input type="text" name="digit1">

<input type="submit" value="go!" name="go">
</form>
<?
if (isset($_POST['go']))
{
if (is_numeric($_POST['digit1']))
{
$data=array();
$max=-100;
$even=array();
$uneven=array();

for($i=0;$i<(int)$_POST['digit1'];$i++)
{
$per=rand(-100,100);
$data[]=$per;
if ($max<$per)
$max=$per;
}
foreach ($data as $key => $value) {
if (($key%2)==0)
{
$even[]=$value;
} 
else $uneven[]=$value;
}
print('Исходный массив<br>');
print_r($data);

asort($even);
asort($uneven);
foreach ($uneven as $key => $value) {
$res[]=$value;

if ($key<=count($even))
{
$res[]=$even[$key];
}
}
print("<br>");
print("Сортировка четных и не четных элементов в рамках одного массива <br>");
print_r($res);
print("<br>");
print("не четный <br>");
print_r($uneven);
print("<br>");
print("четный <br>");
print_r($uneven);
$underZero=1;

foreach ($data as $key => $value) {
if ($value<0)
{
$underZero=$underZero*$value;
}
}
$sum=0;
print("<br>");
print("Произведение отрицательных элементов : ".$underZero);
foreach ($data as $key => $value) {
	if ((int)$value<0)
	{
		if ($value<$max)
			$sum+=(int)$value;
		else break;
	} else break;
}
print("<br>");
print("сумма элементов до максимального : ".$sum);
print("<br>");
print("Максимальный элемент : ".$max);
}
}

?>