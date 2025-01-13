<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      $this->Image('../../assets/images/logo-color-1.png', 150, 9, 50); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(50); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      //$this->Cell(110, 15, utf8_decode('DSITELLO'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->MultiCell(80,12,iconv("UTF-8", "ISO-8859-1",strtoupper("DSITELLO")),1, 'C', false);
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
      $this->Cell(80); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(30, 10, iconv("UTF-8", "ISO-8859-1","REPORTE DE CLIENTES"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(0, 0, 139); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(20, 10, iconv("UTF-8", "ISO-8859-1","CÓDIGO"), 1, 0, 'C', 1);
      $this->Cell(70, 10, iconv("UTF-8", "ISO-8859-1","NOMBRES"), 1, 0, 'C', 1);
      $this->Cell(70, 10, iconv("UTF-8", "ISO-8859-1","DIRECCIÓN"), 1, 0, 'C', 1);
      $this->Cell(30, 10,iconv("UTF-8", "ISO-8859-1","TELEFONO"), 1, 1, 'C', 1);

   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, iconv("UTF-8", "ISO-8859-1","Página") . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(350, 10, iconv("UTF-8", "ISO-8859-1",$hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

require '../../modelos/conexion.php';  
$conex=new Conexion();  
$stmt=$conex->prepare("select * from cliente");
$stmt->execute();

$pdf = new PDF();
$pdf->AddPage("portrait"); /* aqui entran dos para parametros (horientacion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$pdf->SetFont('Arial', '', 10);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
while($row_cliente=$stmt->fetch(PDO::FETCH_ASSOC))
{
    $pdf->Cell(20,10,iconv("UTF-8", "ISO-8859-1",$row_cliente['id_cliente']),1,0,'C');
    $pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1",$row_cliente['nom_cliente']),1,0,'C');
    $pdf->Cell(70,10,iconv("UTF-8", "ISO-8859-1",$row_cliente['direccion']),1,0,'C');
    $pdf->Cell(30,10,iconv("UTF-8", "ISO-8859-1",$row_cliente['telefono']),1,1,'C');
}

$pdf->Output('RClientes.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
