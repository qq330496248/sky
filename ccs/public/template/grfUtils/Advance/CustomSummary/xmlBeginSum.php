<? include '../../data/mysql_GenXmlData.php'; ?>
<?php
//这个例子程序可以分别眼演示MYSQL、MSSQL与ODBC这几种数据访问方式，
//将上面的include包含文件改为mysql_GenXmlData，就是采用MYSQL数据
//将上面的include包含文件改为mssql_GenXmlData，就是采用MSSQL数据
//将上面的include包含文件改为odbc_GenXmlData，就是采用ODBC数据
$QuerySQL = <<<QuerySQL
select d.Productid,sum(d.Quantity) as Quantity,sum(d.UnitPrice*d.Quantity) as Amount 
from orders m inner join OrderDetails d on m.orderid=d.orderid 
where (m.OrderDate between '1997-1-1' And '1997-3-31') 
group by d.ProductID 
order by d.ProductID
QuerySQL;
XML_GenOneRecordset($QuerySQL);
?> 