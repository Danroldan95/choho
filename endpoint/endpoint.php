<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /*	Respuesta Estandar por Protocolo HTTP POST	*/
    header("HTTP/1.1 200 OK");
    /* Lectura de Datos que consumen el servicio	*/
    $data = file_get_contents('php://input');
    /* Decodificación Json para lectura de datos */
    $data = json_decode($data, true);
    $i = 0;
    /* Array de Clientes asignados  */
    $clientes = $data['clientes'];
    foreach ($clientes as $cliente) {
        $detalle_pedidos = $data['clientes'][$i]['detalle_pedidos'];
        /* Array de Deatalle pedido Cliente  */
        $j = 0;
        foreach ($detalle_pedidos as $pedidos) {
            echo $pedidos['fecha_pago'];

            $productos = $detalle_pedidos[$j]['productos'];
            /* Array de Productos Pedido Recibido  */
            foreach ($productos as $producto) {
                /* Llenar array Productos  */
                $products[] = array(
                    "id_producto" => $producto['id_producto'],
                    "tipo" => $producto['tipo'],
                    "cantidad" => $producto['cantidad'],
                    "valor_unitario" => $producto['valor_unitario'],
                    "total" => $producto['total'],
                );
            }
            /* Llenar array Pedidos  */
            $det_pedido[] = array(
                "id_pedido" => $pedidos['id_pedido'],
                "total_productos" => $pedidos['total_productos'],
                "total_pedido" => $pedidos['total_pedido'],
                "estado" => $pedidos['estado'],
                "fecha_pago" => $pedidos['fecha_pago'],
                "productos" => $products
            );
            $j++;
        }
        /* Llenar array Cliente  */
        $client[] = array(
            "id_cliente" => $cliente['id_cliente'],
            "total_pedidos" => $cliente['total_pedidos'],
            "nombre" => $cliente['nombre'],
            "detalle_pedidos" => $det_pedido
        );
        $i++;
    }
    /* Llenar array Información basica Asesor y la informació relacionada de venta  */
    $asesor[] = array(
        "codigo_asesor" => $data['codigo_asesor'],
        "nombre" => $data['nombre'],
        "clientes_asignados" => $data['clientes_asignados'],
        "total_pedidos" => $data['total_pedidos'],
        "clientes" => $client

    );
    /* Codificar y Mostrar datos del Asesor en Fto JSON  */
    $data = json_encode($asesor, JSON_PRETTY_PRINT);
    echo $data;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /*	Recepción datos Mestodo Get	*/
    $data = $_GET['data'];
    /* Decodificación Json para lectura de datos */
    $data = json_decode($data, true);
    $i = 0;
    /* Array de Clientes asignados  */
    $clientes = $data['clientes'];
    foreach ($clientes as $cliente) {
        $detalle_pedidos = $data['clientes'][$i]['detalle_pedidos'];
        /* Array de Deatalle pedido Cliente  */
        $j = 0;
        foreach ($detalle_pedidos as $pedidos) {
            echo $pedidos['fecha_pago'];

            $productos = $detalle_pedidos[$j]['productos'];
            /* Array de Productos Pedido Recibido  */
            foreach ($productos as $producto) {
                /* Llenar array Productos  */
                $products[] = array(
                    "id_producto" => $producto['id_producto'],
                    "tipo" => $producto['tipo'],
                    "cantidad" => $producto['cantidad'],
                    "valor_unitario" => $producto['valor_unitario'],
                    "total" => $producto['total'],
                );
            }
            /* Llenar array Pedidos  */
            $det_pedido[] = array(
                "id_pedido" => $pedidos['id_pedido'],
                "total_productos" => $pedidos['total_productos'],
                "total_pedido" => $pedidos['total_pedido'],
                "estado" => $pedidos['estado'],
                "fecha_pago" => $pedidos['fecha_pago'],
                "productos" => $products
            );
            $j++;
        }
        /* Llenar array Cliente  */
        $client[] = array(
            "id_cliente" => $cliente['id_cliente'],
            "total_pedidos" => $cliente['total_pedidos'],
            "nombre" => $cliente['nombre'],
            "detalle_pedidos" => $det_pedido
        );
        $i++;
    }
    /* Llenar array Información basica Asesor y la informació relacionada de venta  */
    $asesor[] = array(
        "codigo_asesor" => $data['codigo_asesor'],
        "nombre" => $data['nombre'],
        "clientes_asignados" => $data['clientes_asignados'],
        "total_pedidos" => $data['total_pedidos'],
        "clientes" => $client

    );
    /* Codificar y Mostrar datos del Asesor en Fto JSON  */
    $data = json_encode($asesor, JSON_PRETTY_PRINT);
    echo $data;
}
