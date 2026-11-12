<?php
require('../../fpdf181/fpdf_protection.php');
    class PDF extends PDF_PageGroup
    {

      function Header()
     {                                              //ejeX,ejeY,largo,ancho
        $this->Image("../../Logo/logo4.png" , 10 ,2, 60 , 15 , "PNG" ,"");
        //$this->Image("../../Logo/logo_elecciones.jpeg" , 10 ,0, 50 , 20 , "JPEG" ,"");
        $this->SetXY(5,19);
        $this->SetFont('Arial','',8);
        $this->Cell(20,3,"CURP: ",0,0,'L');//C = CENTRAR
        
        $this->SetFont('Arial','B',10);
        $this->SetXY(57,15.5);
        $this->Cell(60,4,'UNIDAD ADMINISTRATIVA',0,0,'C');//C = CENTRAR        
        //<--------------------------------------------------------------------TABLA FORMATO UNICO DE PERSONAL-------------------------------------------->
        $this->Line(347, 11.8, 270-5, 11.8);//parte de arriba
        $this->Line(265, 11.8, 265, 19);//parte izquierda

        $this->SetFont('Arial','B',11);
        $this->SetXY(264,8.8);
        $this->Cell(80,3,utf8_decode('FORMATO ÚNICO DE PERSONAL'),0,0,'L');//C = CENTRAR
        $this->SetXY(265,12.3);
        $this->SetFont('Arial','B',10);
        $this->Cell(80,3,"NO. DOCTO                   FECHA",0,0,'L');
        $this->Line(347, 15.5, 270-5, 15.5);//en medio
        
        $this->Line(347, 19, 270-5, 19);//abajo
        $this->Line(347, 204.3, 347, 11.8);//linea vertical derecha //MARGEN DERECHO
        //<-----------------------------------------------------------------------FIN DE TABLA FORMATO UNICO DE PERSONAL---------------------------------->
        //<-----------------------------------------------------------------------DE FILIACION A DOMICILIO------------------------------------------------>
        $this->Line(5.1, 22.4, 5.1, 204.3);//linea vertical izquerda //MARGEN IZQUIERDO
        $this->Line(5, 22.4, 352-5, 22.4);//PARTE DE ARIIBA //-> DERECHA (DONDE EMPIEZA), ALTURA, LARGO, ALTURA 

        $this->SetXY(5,22.5);
        $this->SetFont('Arial','B',8);
        $this->Cell(20,3," FILIACION                           NOMBRE                                                                                             LUG. NAC.          SEXO             E.CIV                 DOMICILIO",0);

        $this->Line(5, 25.1, 220-5, 25.1);//parte de abajo

        $this->Line(5, 28.5, 220-5, 28.5);
        $this->Line(215, 31.7, 215, 22.4);//linea vertical derecha //CAMBIAR
        //<-----------------------------------------------------------------------FIN DE FILIACION A DOMICILIO------------------------------------------->
        //<-----------------------------------------------------------------------DE CALLE A MUNICIPIO--------------------------------------------------->
        $this->SetXY(215,22.5);
        $this->SetFont('Arial','B',8);
        $this->Cell(90,3,"CALLE: ",0);
        

        $this->SetXY(300,22.5);
        $this->SetFont('Arial','',8);
        $this->Cell(40,3,"C.P. ",0);
       

        $this->SetXY(215,25.8);
        $this->SetFont('Arial','',8);
        $this->Cell(10,3,"LOC.: ",0);
        

        $this->SetXY(215,29);
        $this->SetFont('Arial','',8);
        $this->Cell(20,3,"MUNICIPIO: ",0);
        //<-----------------------------------------------------------------------FIN DE CALLE A MUNICIPIO----------------------------------------------->  
        //<-----------------------------------------------------------------------ANTIGUEDAD A GUIONES--------------------------------------------------->
        $this->SetXY(25,28.9);
        $this->SetFont('Arial','',8);
        $this->Cell(210,3,"                  ANTIGUEDAD                           REGISTRO                             GUIONES",0);
        $this->Line(5, 31.7, 352-5, 31.7);
        //<-----------------------------------------------------------------------FIN DE ANTIGUEDAD A GUIONES-------------------------------------------->
        //<-----------------------------------------------------------------------DE PUESTO A HORAS------------------------------------------------------>
        $this->SetXY(5,32);
        //$this->Line(5, 18.4, 220-5, 18.4);
        $this->Cell(340,3," PUESTO    GOB.FED     SEP        RAMA           TITULO         LICENCIATURA Q   A        LIC.          TIT.       MA.       DO.      C.T.                HORAS   C.T               HORAS    C.T.                HORAS   C.T.                  HORAS  C.T.               HORAS  C.T.                   HORAS",0);
        $this->Line(5, 34.6, 352-5, 34.6);
        $this->Line(5, 38.1, 352-5, 38.1);
        //<-----------------------------------------------------------------------FIN DE PUESTO A HORAS---------------------------------------------------->
        //<-----------------------------------------------------------------------CLAVES DE PAGO A PERCEPCIONES-------------------------------------------->
        $this->SetXY(10,38.2);
        $this->SetFont('Arial','',8.5);
        $this->Cell(340,3,"                   CLAVES DE PAGO            TIPO                                                                                                             P E R C E P C I O N E S",0);
        $this->Line(5, 41, 352-5, 41);
        //<-----------------------------------------------------------------------FIN DE CLAVES DE PAGO A PERCEPCIONES------------------------------------->
        //<-----------------------------------------------------------------------DE PDA A DOCTO----------------------------------------------------------->
        $this->SetXY(5,41.1);
        $this->SetFont('Arial','',7.5);
        $this->Cell(340,3," PDA. CP  U  SU  CATEG.  HRS.  PLAZA   ALTA  CPTO/IMPTE.    DESDE   HASTA NO. DOCTO  CPTO/IMPTE.   DESDE HASTA NO. DOCTO  CPTO/IMPTE.    DESDE  HASTA  NO. DOCTO  CPTO/IMPTE.   DESDE HASTA  NO. DOCTO  CPTO/IMPTE.   DESDE HASTA  NO. DOCTO",0);
        $this->Line(5, 44.2, 352-5, 44.2);
       
        //<-----------------------------------------------------------------------FIN DE PDA A DOCTO-------------------------------------------------->
        //<-----------------------------------------------------------------------TOTAL ACUMULADO----------------------------------------------------->
        $this->Line(5, 74.9, 352-5, 74.9);
        $this->SetXY(0,75);
        $this->SetFont('Arial','',7);
        $this->Cell(80,3,"                                           TOTAL ACUMULADO:",0);
        $this->Line(5, 77.6, 352-5, 77.6);
        $this->Line(5, 80.5, 352-5, 80.5);
        $this->Line(5, 83.7, 352-5, 83.7);
        $this->Line(5, 86.6, 352-5, 86.6);
        //<-----------------------------------------------------------------------FIN DE TOTAL ACUMULADO----------------------------------------------------->
        //<-----------------------------------------------------------------------MOVIMIENTOS---------------------------------------------------------------->
        $this->Line(5, 110.5, 352-5, 110.5);
        $this->SetXY(130,110.8); 
        $this->SetFont('Arial','',9);
        $this->Cell(80,3,"M O V I M I E N T O S",0,0,'C');
        $this->Line(5, 114.2, 352-5, 114.2);
        //<-----------------------------------------------------------------------FIN DE MOVIMIENTOS--------------------------------------------------------->
        //<-----------------------------------------------------------------------TM A QNA. ING-------------------------------------------------------------->
        $this->SetXY(5,114.7); 
        $this->SetFont('Arial','',8); 
        $this->Cell(80,3," T   M                                                               EFECTOS                                            D A T O S D E L( L O S ) S U B S T I T U I D O( S )                                                                                                      N U E V O                                                          QNA.ING",0,0,'L');
        $this->Line(5, 117.4, 352-5, 117.4);
        //<---------------------------------------------------------------------FIN DE TM A QNA.ING---------------------------------------------------------->
        //<---------------------------------------------------------------------M A DESCRIPCION-------------------------------------------------------------->
        $this->SetXY(5,117.9); 
        $this->SetFont('Arial','',8);
        $this->Cell(80,3," M  O  PDA.  CP    U    SU  CATEG. HRS.  PLAZA   DESDE  HASTA   NOMBRE                                                                           FILIACION             MOT. EFECTOS            NO.DOCTO    C.T.                 NIV.SDO.BASIF.PROMOC. SUBSIS. DESCRIPCION",0,0,'L');
        
        $this->Line(5, 120.6, 352-5, 120.6);
        $this->Line(5, 162.2, 352-5, 162.2);
        //<-----------------------------------------------------------------------FIN DE M A DESCRIPCION------------------------------------------------------>
        //<-----------------------------------------------------------------------DOCUMENTACION ANEXA--------------------------------------------------------->
        $this->SetXY(5,162);  
        $this->SetFont('Arial','B',7.5);
        $this->Cell(42,4,"DOCUMENTACION ANEXA",0,0,'L');
        //$this->Line(90, 162.3, 90, 204.4);//linea vertical derecha
        //<-----------------------------------------------------------------------OBSERVACIONES-------------------------------------------------------------->
        $this->SetXY(125,162);  
        $this->SetFont('Arial','B',7.5);
        $this->Cell(42,4,"OBSERVACIONES",0,0,'L');
        //$this->Line(190, 162.3, 190, 181.2);//linea vertical derecha
        //<-----------------------------------------------------------------------OTROS--------------------------------------------------------------------->
    }
    }
  ?>