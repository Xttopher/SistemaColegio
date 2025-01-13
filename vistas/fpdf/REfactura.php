<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      $this->Image('../../assets/images/logo-color-1.png', 230, 10, 50); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(80); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, iconv("UTF-8", "ISO-8859-1",strtoupper("DSITELLO")), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)  
      $this->Ln(7); // Salto de línea
      $this->SetTextColor(103); //color

    /*  /* UBICACION
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, iconv("UTF-8", "ISO-8859-1","Ubicación : "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, iconv("UTF-8", "ISO-8859-1","Teléfono : "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, iconv("UTF-8", "ISO-8859-1","Correo : "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, iconv("UTF-8", "ISO-8859-1","Sucursal : "), 0, 0, '', 0);
      $this->Ln(10); */

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 0, 139);
      $this->Cell(90); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, iconv("UTF-8", "ISO-8859-1","REPORTE DE FACTURAS POR AÑO"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(0, 0, 139); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(10, 10, iconv("UTF-8", "ISO-8859-1","ID"), 1, 0, 'C', 1);
      $this->Cell(90, 10, iconv("UTF-8", "ISO-8859-1","CLIENTE"), 1, 0, 'C', 1);
      $this->Cell(90, 10, iconv("UTF-8", "ISO-8859-1","FECHA"), 1, 0, 'C', 1);
      $this->Cell(30, 10, iconv("UTF-8", "ISO-8859-1","SUBTOTAL"), 1, 0, 'C', 1);
      $this->Cell(30, 10, iconv("UTF-8", "ISO-8859-1","IGV"), 1, 0, 'C', 1);
      $this->Cell(30, 10, iconv("UTF-8", "ISO-8859-1","TOTAL"), 1, 1, 'C', 1);

   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, iconv("UTF-8", "ISO-8859-1","Página")  . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(520, 10, iconv("UTF-8", "ISO-8859-1",$hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}
$cadena="";
require '../../modelos/conexion.php';  
$conex=new Conexion();  
if($_GET['ncli']!="" || $_GET['f']!="- Seleccione Año -")
{
    $stmt=$conex->prepare("select * from vlista_factura where nom_cliente=? and YEAR(FECHA)=?");
    $stmt->bindParam(1,$_GET['ncli']);
    $stmt->bindParam(2,$_GET['f']);
}
if($_GET['f']=="- Seleccione Año -")
{
    $stmt=$conex->prepare("select * from vlista_factura where nom_cliente=?");
    $stmt->bindParam(1,$_GET['ncli']);
}
if($_GET['ncli']=="")
{
    $stmt=$conex->prepare("select * from vlista_factura where YEAR(FECHA)=?");
    $stmt->bindParam(1,$_GET['f']);
}

$stmt->execute();

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientacion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
while($row_factura=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $pdf->Cell(10,10,iconv("UTF-8", "ISO-8859-1",$row_factura['id_factura']),1,0,'C');
    $pdf->Cell(90,10,iconv("UTF-8", "ISO-8859-1",$row_factura['nom_cliente']),1,0,'C');
    $pdf->Cell(90,10,iconv("UTF-8", "ISO-8859-1",date("d/m/Y", strtotime($row_factura['fecha']))),1,0,'C');
    $pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1",$row_factura['subtotal']),1,0,'C');
    $pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1",$row_factura['igv']),1,0,'C');
    $pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1",$row_factura['total']),1,1,'C');
}


$pdf->Output('REfactura.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
