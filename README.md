REQUISITOS

El sistema fue desarrollado bajo el lenguaje de programación  Php en su versión 8 en conjunto con base de datos Postgres, el programa fue desplegado en localhost y con directorio principal "choho".

Nota:

Se relaciona estructura de cada una de las tablas usadas para el desarrollo de la API y la base de datos nombrada "choho"

CREATE TABLE IF NOT EXISTS public.asesores
(
    id_asesor character varying COLLATE pg_catalog."default" NOT NULL,
    nombre character varying COLLATE pg_catalog."default",
    clientes_asignados smallint,
    total_pedidos smallint,
    id_cliente bigint,
    CONSTRAINT asesores_pkey PRIMARY KEY (id_asesor)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.asesores
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.clientes
(
    id_cliente bigint NOT NULL,
    total_pedidos smallint,
    nombre character varying COLLATE pg_catalog."default",
    id_pedido smallint,
    id_asesor character varying COLLATE pg_catalog."default",
    CONSTRAINT clientes_pkey PRIMARY KEY (id_cliente)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.clientes
    OWNER to postgres;

CREATE TABLE IF NOT EXISTS public.detalle_pedidos
(
    id_pedido smallint NOT NULL,
    total_productos smallint,
    total_pedido bigint,
    estado boolean,
    fecha_pago date,
    id_cliente bigint,
    CONSTRAINT detalle_pedidos_pkey PRIMARY KEY (id_pedido)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.detalle_pedidos
    OWNER to postgres;


CREATE TABLE IF NOT EXISTS public.productos
(
    id_producto smallint NOT NULL,
    tipo character varying COLLATE pg_catalog."default",
    cantidad smallint,
    valor_unidad bigint,
    id_pedido smallint,
    total bigint,
    CONSTRAINT productos_pkey PRIMARY KEY (id_producto)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.productos
    OWNER to postgres;

