<?php
class Simplex
{
    private $tipo;
    private $num_variables;
    private $num_restricciones;
    private $z;
    private $restricciones;
    private $total_variables;
    private $tableau = [];
    private $response_html = "";
    private $iteracion = 0;
    private $MAX_ITERACIONES = 100;
    private $resultados;
    private $identificadores = [];

    function __construct($tipo, $num_variables, $num_restricciones, $z, $restricciones)
    {
        $this->tipo = $tipo;
        $this->num_variables = $num_variables;
        $this->num_restricciones = $num_restricciones;
        $this->z = $z;
        $this->restricciones = $restricciones;
        $this->total_variables = $num_restricciones * 2;    

        $this->iniciar();
    }

    private function iniciar()
    {
        //RESTRICCIONES - TABLEU
        for($f=0;$f<$this->num_restricciones;$f++)
        {
            array_push($this->identificadores, "X".(($this->num_restricciones+1)+$f));            
            $this->tableau[0][$f] = [0];
            for($i=0;$i<$this->num_variables;$i++){
                array_push($this->tableau[0][$f], $this->restricciones[$f]['valores'][$i]);
            }

            //HOLGURAS
            for($i=0;$i<$this->num_restricciones;$i++)
            {
                if($i==$f)
                {
                    array_push($this->tableau[0][$f], 1);
                }else{
                    array_push($this->tableau[0][$f], 0);
                }
                
            }

            //VALOR
            array_push($this->tableau[0][$f], $this->restricciones[$f]['val']);
        }
        array_push($this->identificadores, "Z");

        //Z - TABLEU
        $this->tableau[0][$this->num_restricciones] = [1];
        for($i=0;$i<$this->num_variables;$i++)
        {
            array_push($this->tableau[0][$this->num_restricciones], $this->z[$i] * -1);
        }
        for($i=0;$i<$this->num_restricciones+1;$i++)
        {
            array_push($this->tableau[0][$this->num_restricciones], 0);
        }

        //print_r($this->tableau);
        //print_r($this->identificadores);

        $this->imprimir_tabla(0);

        $this->buscar_resultado();
    }

    //Me fijo que toda la Z esté positiva
    private function hay_resultado()
    {
        for($i=0; $i<($this->num_restricciones+$this->num_variables+2);$i++)
        {
            if($this->tableau[$this->iteracion][$this->num_restricciones][$i] < 0)
            {
                return false;
            }
        }

        return true;
    }

    private function buscar_resultado()
    {
        while(!$this->hay_resultado() && $this->iteracion<=$this->MAX_ITERACIONES)
        {
            $this->iteracion();
            $this->variable_entrante();

            $this->imprimir_tabla($this->iteracion);
        }
        $this->response_html .= "RESULTADO!";
    }

    private function variable_entrante()
    {
        $columna_pivote = $this->encontrar_columna_pivote();
        $fila_pivote = $this->encontrar_fila_pivote($columna_pivote);
        $this->identificadores[$fila_pivote] = "X$columna_pivote";

        $elemento_pivote = $this->tableau[$this->iteracion][$fila_pivote][$columna_pivote];
        
        //Dividimos la nueva fila con el elemento pivote
        for($i=0;$i<count($this->tableau[$this->iteracion][$fila_pivote]);$i++)
        {
            $this->tableau[$this->iteracion][$fila_pivote][$i] = $this->tableau[$this->iteracion-1][$fila_pivote][$i] / $elemento_pivote;

        }

        //Calculamos las nuevas filas - FILA VIEJA - (COEFICIENTE PIVOTE * FILA NUEVA)
        for($i=0;$i<$this->num_restricciones+1;$i++)
        {
            //Excluyo fila nueva
            if($i==$fila_pivote)
                continue;
            
            $coeficiente_pivote = $this->tableau[$this->iteracion][$i][$columna_pivote];
            
            for($c=0;$c<count($this->tableau[$this->iteracion][$fila_pivote]);$c++)
            {       
               // echo $this->tableau[$this->iteracion-1][$i][$c]."- (".$coeficiente_pivote. " * ".$this->tableau[$this->iteracion][$fila_pivote][$c].") -";         
                $this->tableau[$this->iteracion][$i][$c] = $this->tableau[$this->iteracion-1][$i][$c] - ($coeficiente_pivote * $this->tableau[$this->iteracion][$fila_pivote][$c]);
            }
           // echo "<br>";
        }

    }

    private function iteracion()
    {
        $this->tableau[$this->iteracion+1] = $this->tableau[$this->iteracion];
        $this->iteracion++;
    }


    private function imprimir_tabla($index)
    {
        $ret = "
        <table class='table'>
        <tr>
        <th></th>
        <th>Z</th>";
    
        for($i=1;$i<$this->num_variables+$this->num_restricciones+1;$i++)
        {
            $ret .= "<th>X$i</th>";
        }
        $ret .= "
        <th>LD</th>
        </tr>";
    
        for($i=0;$i<$this->num_restricciones+1;$i++)
        {
            $ret .= "<tr>";
            $ret .= "<th>".$this->identificadores[$i]."</th>";
            for($c=0;$c<($this->num_restricciones+$this->num_variables+2);$c++){
                $ret .= "<td>{$this->tableau[$index][$i][$c]}</td>";
            }
            $ret .= "</tr>";
        }
    
        $ret .= "</table>";
    
        $this->response_html .= $ret;
    }

    //Dividir Lado derecho con Columna pivote y buscar el menor
    private function encontrar_fila_pivote($columna_pivote)
    {
        $res = [];
        //Divido lado derecho con columna pivote
        for($i=0;$i<$this->num_restricciones;$i++)
        {
            //echo $this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1] . " / " . $this->tableau[$this->iteracion][$i][$columna_pivote];
            try{
                $this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1] = $this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1] / $this->tableau[$this->iteracion][$i][$columna_pivote];
            }catch(Exception $e)
            {
                $this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1] = 0;
            }
            //$this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1] = $this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1] / $this->tableau[$this->iteracion][$i][$columna_pivote];
            array_push($res, $this->tableau[$this->iteracion][$i][count($this->tableau[$this->iteracion][$i])-1]);
            //echo "<br>";
        }

        //Busco menor
        $menor = $res[0];
        $fila = 0;
        for($i=0;$i<count($res);$i++)
        {
            if($res[$i] < $menor)
            {
                $menor = $res[$i];
                $fila = $i;
            }
        }

       // echo "sadasd: ".$fila."<br>";
        return $fila;

    }

    //Valor de Z mas bajo
    private function encontrar_columna_pivote()
    {
        $b = $this->tableau[$this->iteracion][$this->num_restricciones][0];
        $pivote = 0;
        for($i=0; $i<($this->num_restricciones+$this->num_variables+2);$i++)
        {
            if($this->tableau[$this->iteracion][$this->num_restricciones][$i] < $b)
            {
                $b = $this->tableau[$this->iteracion][$this->num_restricciones][$i];
                $pivote = $i;
            }
        }

       // echo "columna: ".$pivote."<br>";

        return $pivote;
    }

    public function response()
    {
        return $this->response_html;
    }


}
