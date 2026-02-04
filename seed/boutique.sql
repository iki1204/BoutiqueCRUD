/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     3/2/2026 22:31:27                            */
/*==============================================================*/


drop table if exists _CODE_CATEGORIA;

drop table if exists _CODE_CLIENTE;

drop table if exists _CODE_DETALLE_VENTA;

drop table if exists _CODE_EMPLEADO;

drop table if exists _CODE_PRODUCTO;

drop table if exists _CODE_PROVEEDOR;

drop table if exists _CODE_TALLA;

drop table if exists _CODE_VENTAS;

/*==============================================================*/
/* Table: _CODE_CATEGORIA                                       */
/*==============================================================*/
create table _CODE_CATEGORIA
(
   CATEGORIA_ID         int not null,
   CODIGO               varchar(50),
   DESCRIPCION          varchar(200),
   primary key (CATEGORIA_ID)
);

/*==============================================================*/
/* Table: _CODE_CLIENTE                                         */
/*==============================================================*/
create table _CODE_CLIENTE
(
   CLIENTE_ID           int not null,
   CODIGO               varchar(50),
   APELLIDO             varchar(50),
   TELEFONO             varchar(15),
   EMAIL                varchar(100),
   DIRECCION            varchar(300),
   primary key (CLIENTE_ID)
);

/*==============================================================*/
/* Table: _CODE_DETALLE_VENTA                                   */
/*==============================================================*/
create table _CODE_DETALLE_VENTA
(
   DETALLE_ID           int not null,
   VENTA_ID             int not null,
   PRODUCTO_ID          int not null,
   CANTIDAD             int,
   PRECIO               decimal(10,2),
   primary key (DETALLE_ID)
);

/*==============================================================*/
/* Table: _CODE_EMPLEADO                                        */
/*==============================================================*/
create table _CODE_EMPLEADO
(
   EMPLEADO_ID          int not null,
   CODIGO               varchar(50),
   APELLIDO             varchar(50),
   CARGO                varchar(50),
   TELEFONO             varchar(15),
   DIRECCION            varchar(300),
   FECHA_INGRESO        timestamp,
   primary key (EMPLEADO_ID)
);

/*==============================================================*/
/* Table: _CODE_PRODUCTO                                        */
/*==============================================================*/
create table _CODE_PRODUCTO
(
   PRODUCTO_ID          int not null,
   CATEGORIA_ID         int not null,
   PROVEEDOR_ID         int not null,
   TALLA_ID             int not null,
   CODIGO               varchar(50),
   DESCRIPCION          varchar(200),
   COLOR                varchar(10),
   MARCA                varchar(30),
   STOCK                int,
   PRECIO               decimal(10,2),
   primary key (PRODUCTO_ID)
);

/*==============================================================*/
/* Table: _CODE_PROVEEDOR                                       */
/*==============================================================*/
create table _CODE_PROVEEDOR
(
   PROVEEDOR_ID         int not null,
   NOMBRE_EMPRESA       varchar(50),
   TELEFONO             varchar(15),
   EMAIL                varchar(100),
   DIRECCION            varchar(300),
   CIUDAD               varchar(50),
   primary key (PROVEEDOR_ID)
);

/*==============================================================*/
/* Table: _CODE_TALLA                                           */
/*==============================================================*/
create table _CODE_TALLA
(
   TALLA_ID             int not null,
   CODIGO               varchar(50),
   DESCRIPCION          varchar(200),
   primary key (TALLA_ID)
);

/*==============================================================*/
/* Table: _CODE_VENTAS                                          */
/*==============================================================*/
create table _CODE_VENTAS
(
   VENTA_ID             int not null,
   CLIENTE_ID           int not null,
   EMPLEADO_ID          int not null,
   FECHA                datetime,
   TOTAL                decimal(10,2),
   ESTADO               varchar(100),
   METODO_PAGO          varchar(100),
   primary key (VENTA_ID)
);

alter table _CODE_DETALLE_VENTA add constraint FK_DETALLE_VENTA foreign key (VENTA_ID)
      references _CODE_VENTAS (VENTA_ID) on delete restrict on update restrict;

alter table _CODE_DETALLE_VENTA add constraint FK_DETALLE_VENTA2 foreign key (PRODUCTO_ID)
      references _CODE_PRODUCTO (PRODUCTO_ID) on delete restrict on update restrict;

alter table _CODE_PRODUCTO add constraint FK_CATEGORIA_PRODUCTO foreign key (CATEGORIA_ID)
      references _CODE_CATEGORIA (CATEGORIA_ID) on delete restrict on update restrict;

alter table _CODE_PRODUCTO add constraint FK_PROVEEDOR_PRODUCTO foreign key (PROVEEDOR_ID)
      references _CODE_PROVEEDOR (PROVEEDOR_ID) on delete restrict on update restrict;

alter table _CODE_PRODUCTO add constraint FK_TALLA_PRODUCTO foreign key (TALLA_ID)
      references _CODE_TALLA (TALLA_ID) on delete restrict on update restrict;

alter table _CODE_VENTAS add constraint FK_CLIENTE_VENTAS foreign key (CLIENTE_ID)
      references _CODE_CLIENTE (CLIENTE_ID) on delete restrict on update restrict;

alter table _CODE_VENTAS add constraint FK_EMPLEADO_VENTA foreign key (EMPLEADO_ID)
      references _CODE_EMPLEADO (EMPLEADO_ID) on delete restrict on update restrict;

