<?php
/* Función Clientes  */
function clientes($accion, $condiciones, $orden)
{
    switch ($accion) {
            /*  C: Permite consultar los clientes asignados de un asesor así como sus pedidos*/
        case 'C':
            /* Consulta Aseosr y sus clientes asignados */
            $sql = "select a.id_asesor,a.nombre, a.clientes_asignados, a.total_pedidos
                    from asesores a
                where a.id_asesor='" . $condiciones . "'";
            $rs = ejecutar_sql($sql);
            $fila = pg_fetch_array($rs);
            /*  Consulta clientes según el asesor */
            $sql = "select id_cliente,total_pedidos,nombre,id_pedido
            from clientes
            where id_asesor='" . $fila['id_asesor'] . "'";
            $rs_cl = ejecutar_sql($sql);
            while ($fila_cl = pg_fetch_array($rs_cl)) {
                /* Recorre y Consulta de pedidos según clientes */
                $sql = "select id_pedido,total_productos,total_pedido,estado,fecha_pago
                from detalle_pedidos
                where id_cliente=" . $fila_cl['id_cliente'] . "";
                $rs_pe = ejecutar_sql($sql);
                while ($fila_pe = pg_fetch_array($rs_pe)) {
                    /* Recorre y Consulta de pedidos según clientes */
                    $sql = "select id_producto,tipo,cantidad,valor_unidad,total
                    from productos
                    where id_pedido=" . $fila_pe['id_pedido'] . "";
                    $rs_pr = ejecutar_sql($sql);
                    /* Recorre y Consulta productos que solicito cada cliente   */
                    while ($fila_pr = pg_fetch_array($rs_pr)) {
                        /* Llena array de productos */
                        $productos[] = array(
                            "id_producto" => $fila_pr['id_producto'],
                            "tipo" => $fila_pr['tipo'],
                            "cantidad" => $fila_pr['cantidad'],
                            "valor_unitario" => $fila_pr['valor_unidad'],
                            "total" => $fila_pr['total'],
                        );
                    }
                    /* Llena array de pedidos */
                    $det_pedido[] = array(
                        "id_pedido" => $fila_pe['id_pedido'],
                        "total_productos" => $fila_pe['total_productos'],
                        "total_pedido" => $fila_pe['total_pedido'],
                        "estado" => $fila_pe['estado'],
                        "fecha_pago" => $fila_pe['fecha_pago'],
                        "productos" => $productos
                    );
                }
                /* Llena array de clientes */
                $clientes[] = array(
                    "id_cliente" => $fila_cl['id_cliente'],
                    "total_pedidos" => $fila_cl['total_pedidos'],
                    "nombre" => $fila_cl['nombre'],
                    "detalle_pedidos" => $det_pedido
                );
            }
            /* Llena array de Asesores */
            $asesor = array(
                "codigo_asesor" => $fila['id_asesor'],
                "nombre" => $fila['nombre'],
                "clientes_asignados" => $fila['clientes_asignados'],
                "total_pedidos" => $fila['total_pedidos'],
                "clientes" => $clientes

            );

            //  Generar metodo de envio POST con formato JSON
            $url = 'https://localhost/choho/endpoint/endpoint.php?WSDL';

            /*  Codificación Array de Asesores a formato JSON   */
            $asesor = json_encode($asesor);

            //create a new cURL resource
            $ch = curl_init($url);

            $data = json_encode($asesor);
            $headers = array(
                'Content-Type: text/json; charset="utf-8"',
                'SOAPAction: ""',
                'Content-Length: ' . strlen($data),
                'Accept: text/xml',
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            );

            /* Conexión y envio de información */
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            //execute the POST request
            $result = curl_exec($ch);
            if ($result == false) {
                echo "No se envio la información";
            }
            //close cURL resource
            curl_close($ch);

            /* Envio de JSON creado por Método GET y redireccionamiento para observar datos */
            header('location: http://localhost/choho/endpoint/endpoint.php?data=' . $asesor);
            break;
    }
}
