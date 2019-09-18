<?php

    require_once '../controladores/productos.controlador.php';
	
    require_once '../modelos/productos.modelo.php';

    require_once '../modelos/conexion.modelo.php';
 
    class AjaxProducto{

        public $id_producto;
        public $nom_producto;

        public function EditarProducto(){

            $item="ID_PRODUCTO";
            $valor=$this->id_producto;

            $respuesta=ControladorProducto::ctrMostrarProductos($item,$valor);

            echo json_encode($respuesta);

        }

        public function VerificarProducto(){

            $flag=false;

            $nombre_producto=$this->nom_producto;

            $productos=ControladorProducto::ctrVerificarProducto();

            foreach ($productos as $key => $value) {

                if($nombre_producto==$value['DESCRIPCION']){

                    $flag=true;

                }

            }

            if($flag){

                $respuesta="Ya existe el producto!";

            }else{

                $respuesta="No existe el producto!";

            }

            echo json_encode($respuesta);

        }

        public function MostrarCategorias(){

            $datos=array();

            $categorias=ControladorProducto::ctrMostrarCategorias();

            foreach ($categorias as $key => $value) {
                
                $datos[$key]=$value['NOMBRE_CATEGORIA'];

            }

            echo json_encode($datos);

        }

    }

    if(isset($_POST['idEditarProducto'])){

            $Producto=new AjaxProducto();

            $Producto -> id_producto=$_POST['idEditarProducto'];

            $Producto -> EditarProducto();

    }

    if(isset($_POST['nomProducto'])){

        $Producto=new AjaxProducto();

        $Producto -> nom_producto=$_POST['nomProducto'];

        $Producto -> VerificarProducto();

    }

    if(isset($_POST['estadoCategoria'])){

        $CatProducto=new AjaxProducto();

        $CatProducto -> MostrarCategorias();

    }


