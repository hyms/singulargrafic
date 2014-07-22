SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table  `producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `producto` ;

CREATE  TABLE IF NOT EXISTS  `producto` (
  `idProducto` INT NOT NULL AUTO_INCREMENT ,
  `servicio` INT NOT NULL ,
  `codigo` VARCHAR(40) NULL ,
  `material` VARCHAR(40) NULL ,
  `color` VARCHAR(40) NULL ,
  `marca` VARCHAR(40) NULL ,
  `industria` VARCHAR(40) NULL ,
  `cantXPaquete` INT NOT NULL ,
  `precioSFU` DOUBLE NOT NULL ,
  `precioSFP` DOUBLE NOT NULL ,
  `precioCFU` DOUBLE NOT NULL ,
  `precioCFP` DOUBLE NOT NULL ,
  `familia` VARCHAR(40) NULL ,
  `detalle` VARCHAR(100) NULL ,
  PRIMARY KEY (`idProducto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `almacen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `almacen` ;

CREATE  TABLE IF NOT EXISTS  `almacen` (
  `idAlmacen` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(20) NULL ,
  `idParent` INT NULL ,
  PRIMARY KEY (`idAlmacen`) ,
  INDEX `fk_almacen_almacen1` (`idParent` ASC) ,
  CONSTRAINT `fk_almacen_almacen1`
    FOREIGN KEY (`idParent` )
    REFERENCES  `almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `cliente` ;

CREATE  TABLE IF NOT EXISTS  `cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT ,
  `nitCi` VARCHAR(20) NULL ,
  `apellido` VARCHAR(40) NULL ,
  `nombre` VARCHAR(40) NULL ,
  `correo` VARCHAR(50) NULL ,
  `fechaRegistro` DATETIME NULL ,
  `telefono` VARCHAR(20) NULL ,
  `direccion` VARCHAR(100) NULL ,
  PRIMARY KEY (`idCliente`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `empleado` ;

CREATE  TABLE IF NOT EXISTS  `empleado` (
  `idEmpleado` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NULL ,
  `apellido` VARCHAR(40) NULL ,
  `fechaRegistro` DATETIME NULL ,
  `email` VARCHAR(50) NULL ,
  `telefono` VARCHAR(20) NULL ,
  `ci` VARCHAR(20) NULL ,
  PRIMARY KEY (`idEmpleado`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `user` ;

CREATE  TABLE IF NOT EXISTS  `user` (
  `idUser` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NULL ,
  `password` VARCHAR(20) NULL ,
  `fechaLogin` DATETIME NULL ,
  `estado` INT NULL ,
  `tipo` VARCHAR(10) NULL ,
  `idEmpleado` INT NULL ,
  PRIMARY KEY (`idUser`) ,
  INDEX `fk_user_empleado1` (`idEmpleado` ASC) ,
  CONSTRAINT `fk_user_empleado1`
    FOREIGN KEY (`idEmpleado` )
    REFERENCES  `empleado` (`idEmpleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `caja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `caja` ;

CREATE  TABLE IF NOT EXISTS  `caja` (
  `idCaja` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `idParent` INT NULL ,
  PRIMARY KEY (`idCaja`) ,
  INDEX `fk_caja_caja1` (`idParent` ASC) ,
  CONSTRAINT `fk_caja_caja1`
    FOREIGN KEY (`idParent` )
    REFERENCES  `caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `cajaMovimientoVenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `cajaMovimientoVenta` ;

CREATE  TABLE IF NOT EXISTS  `cajaMovimientoVenta` (
  `idCajaMovimientoVenta` INT NOT NULL AUTO_INCREMENT ,
  `monto` DOUBLE NOT NULL ,
  `motivo` VARCHAR(100) NOT NULL ,
  `fechaMovimiento` DATETIME NULL ,
  `idUser` INT NULL ,
  `tipo` INT NOT NULL ,
  `arqueo` INT NULL ,
  `idCaja` INT NULL ,
  PRIMARY KEY (`idCajaMovimientoVenta`) ,
  INDEX `fk_movimientoCaja_user1` (`idUser` ASC) ,
  INDEX `fk_cajaMovimientoVenta_caja1` (`idCaja` ASC) ,
  CONSTRAINT `fk_movimientoCaja_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaMovimientoVenta_caja1`
    FOREIGN KEY (`idCaja` )
    REFERENCES  `caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `venta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `venta` ;

CREATE  TABLE IF NOT EXISTS  `venta` (
  `idVenta` INT NOT NULL AUTO_INCREMENT ,
  `fechaVenta` DATETIME NULL ,
  `tipoVenta` INT NULL ,
  `formaPago` INT NULL ,
  `idCliente` INT NULL ,
  `fechaPlazo` DATETIME NULL ,
  `codigo` VARCHAR(45) NULL ,
  `serie` INT NULL ,
  `montoVenta` DOUBLE NOT NULL ,
  `montoPagado` DOUBLE NOT NULL ,
  `montoCambio` DOUBLE NOT NULL ,
  `montoDescuento` DOUBLE NOT NULL ,
  `estado` INT NULL ,
  `factura` VARCHAR(50) NULL ,
  `autorizado` VARCHAR(50) NULL ,
  `responsable` VARCHAR(50) NULL ,
  `obs` VARCHAR(200) NULL ,
  `idCajaMovimientoVenta` INT NULL ,
  `numero` INT NULL ,
  PRIMARY KEY (`idVenta`) ,
  INDEX `fk_venta_cliente1` (`idCliente` ASC) ,
  INDEX `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  CONSTRAINT `fk_venta_cliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES  `cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cajaMovimientoVenta1`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES  `cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `almacenProducto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `almacenProducto` ;

CREATE  TABLE IF NOT EXISTS  `almacenProducto` (
  `idAlmacenProducto` INT NOT NULL AUTO_INCREMENT ,
  `idProducto` INT NULL ,
  `stockU` INT NOT NULL ,
  `stockP` INT NOT NULL ,
  `idAlmacen` INT NULL ,
  PRIMARY KEY (`idAlmacenProducto`) ,
  INDEX `fk_almacenProducto_producto1` (`idProducto` ASC) ,
  INDEX `fk_almacenProducto_almacen1` (`idAlmacen` ASC) ,
  CONSTRAINT `fk_almacenProducto_producto1`
    FOREIGN KEY (`idProducto` )
    REFERENCES  `producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacenProducto_almacen1`
    FOREIGN KEY (`idAlmacen` )
    REFERENCES  `almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `detalleVenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `detalleVenta` ;

CREATE  TABLE IF NOT EXISTS  `detalleVenta` (
  `idDetalleVenta` INT NOT NULL AUTO_INCREMENT ,
  `idVenta` INT NULL ,
  `cantidadU` INT NOT NULL ,
  `costoU` DOUBLE NOT NULL ,
  `cantidadP` INT NOT NULL ,
  `costoP` DOUBLE NOT NULL ,
  `costoAdicional` DOUBLE NOT NULL ,
  `costoTotal` DOUBLE NOT NULL ,
  `idAlmacenProducto` INT NULL ,
  PRIMARY KEY (`idDetalleVenta`) ,
  INDEX `fk_detalleVenta_venta1` (`idVenta` ASC) ,
  INDEX `fk_detalleVenta_almacenProducto1` (`idAlmacenProducto` ASC) ,
  CONSTRAINT `fk_detalleVenta_venta1`
    FOREIGN KEY (`idVenta` )
    REFERENCES  `venta` (`idVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleVenta_almacenProducto1`
    FOREIGN KEY (`idAlmacenProducto` )
    REFERENCES  `almacenProducto` (`idAlmacenProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `cajaArqueo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `cajaArqueo` ;

CREATE  TABLE IF NOT EXISTS  `cajaArqueo` (
  `idCajaVenta` INT NOT NULL AUTO_INCREMENT ,
  `idCaja` INT NULL ,
  `idUser` INT NULL ,
  `monto` DOUBLE NOT NULL ,
  `fechaArqueo` DATETIME NULL ,
  `fechaVentas` DATETIME NULL ,
  `comprobante` VARCHAR(20) NULL ,
  `saldo` DOUBLE NOT NULL ,
  PRIMARY KEY (`idCajaVenta`) ,
  INDEX `fk_cajaVenta_caja1` (`idCaja` ASC) ,
  INDEX `fk_cajaVenta_user1` (`idUser` ASC) ,
  CONSTRAINT `fk_cajaVenta_caja1`
    FOREIGN KEY (`idCaja` )
    REFERENCES  `caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaVenta_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `recibos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `recibos` ;

CREATE  TABLE IF NOT EXISTS  `recibos` (
  `idRecibos` INT NOT NULL AUTO_INCREMENT ,
  `categoria` VARCHAR(40) NULL ,
  `codigo` VARCHAR(20) NULL ,
  `idCliente` INT NULL ,
  `responsable` VARCHAR(40) NULL ,
  `celular` VARCHAR(20) NULL ,
  `fechaRegistro` DATETIME NULL ,
  `concepto` VARCHAR(100) NULL ,
  `codigoNumero` VARCHAR(20) NULL ,
  `servicio` VARCHAR(20) NULL ,
  `monto` DOUBLE NOT NULL ,
  `acuenta` DOUBLE NOT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `obs` VARCHAR(200) NOT NULL ,
  `tipoRecivo` INT NULL ,
  `descuento` DOUBLE NOT NULL ,
  `idCajaMovimientoVenta` INT NOT NULL ,
  PRIMARY KEY (`idRecibos`) ,
  INDEX `fk_recibos_cliente1` (`idCliente` ASC) ,
  INDEX `fk_recibos_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  CONSTRAINT `fk_recibos_cliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES  `cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recibos_cajaMovimientoVenta1`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES  `cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `movimientoAlmacen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `movimientoAlmacen` ;

CREATE  TABLE IF NOT EXISTS  `movimientoAlmacen` (
  `idMovimientoAlmacen` INT NOT NULL AUTO_INCREMENT ,
  `idProducto` INT NULL ,
  `idAlmacenOrigen` INT NULL ,
  `idAlmacenDestino` INT NULL ,
  `cantidadU` INT NOT NULL ,
  `cantidadP` INT NOT NULL ,
  `idUser` INT NULL ,
  `fechaMovimiento` DATETIME NULL ,
  PRIMARY KEY (`idMovimientoAlmacen`) ,
  INDEX `fk_movimientoAlmacen_producto1` (`idProducto` ASC) ,
  INDEX `fk_movimientoAlmacen_almacen1` (`idAlmacenOrigen` ASC) ,
  INDEX `fk_movimientoAlmacen_almacen2` (`idAlmacenDestino` ASC) ,
  INDEX `fk_movimientoAlmacen_user1` (`idUser` ASC) ,
  CONSTRAINT `fk_movimientoAlmacen_producto1`
    FOREIGN KEY (`idProducto` )
    REFERENCES  `producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoAlmacen_almacen1`
    FOREIGN KEY (`idAlmacenOrigen` )
    REFERENCES  `almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoAlmacen_almacen2`
    FOREIGN KEY (`idAlmacenDestino` )
    REFERENCES  `almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoAlmacen_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `Imprenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `Imprenta` ;

CREATE  TABLE IF NOT EXISTS  `Imprenta` (
  `idImprenta` INT NOT NULL AUTO_INCREMENT ,
  `fechaOrden` DATETIME NULL ,
  `tipoOrden` INT NULL ,
  `formaPago` INT NULL ,
  `idCliente` INT NULL ,
  `fechaPlazo` DATETIME NULL ,
  `codigo` VARCHAR(45) NULL ,
  `serie` INT NULL ,
  `montoVenta` DOUBLE NOT NULL ,
  `montoPagado` DOUBLE NOT NULL ,
  `montoCambio` DOUBLE NOT NULL ,
  `montoDescuento` DOUBLE NOT NULL ,
  `estado` INT NOT NULL ,
  `factura` VARCHAR(50) NULL ,
  `autorizado` VARCHAR(50) NULL ,
  `responsable` VARCHAR(50) NULL ,
  `obs` VARCHAR(200) NULL ,
  `idCajaMovimientoVenta` INT NULL ,
  `numero` INT NULL ,
  `idUserOT` INT NOT NULL ,
  `idUserVenta` INT NOT NULL ,
  PRIMARY KEY (`idImprenta`) ,
  INDEX `fk_venta_cliente1` (`idCliente` ASC) ,
  INDEX `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  INDEX `fk_CTP_user1` (`idUserOT` ASC) ,
  INDEX `fk_CTP_user2` (`idUserVenta` ASC) ,
  CONSTRAINT `fk_venta_cliente100`
    FOREIGN KEY (`idCliente` )
    REFERENCES  `cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cajaMovimientoVenta100`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES  `cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user10`
    FOREIGN KEY (`idUserOT` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user20`
    FOREIGN KEY (`idUserVenta` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `CTP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `CTP` ;

CREATE  TABLE IF NOT EXISTS  `CTP` (
  `idCTP` INT NOT NULL AUTO_INCREMENT ,
  `fechaOrden` DATETIME NULL ,
  `tipoOrden` INT NULL ,
  `formaPago` INT NULL ,
  `idCliente` INT NULL ,
  `fechaPlazo` DATETIME NULL ,
  `codigo` VARCHAR(45) NULL ,
  `serie` INT NULL ,
  `montoVenta` DOUBLE NOT NULL ,
  `montoPagado` DOUBLE NOT NULL ,
  `montoCambio` DOUBLE NOT NULL ,
  `montoDescuento` DOUBLE NOT NULL ,
  `estado` INT NOT NULL ,
  `factura` VARCHAR(50) NULL ,
  `autorizado` VARCHAR(50) NULL ,
  `responsable` VARCHAR(50) NULL ,
  `obs` VARCHAR(200) NULL ,
  `idCajaMovimientoVenta` INT NULL ,
  `numero` INT NULL ,
  `idUserOT` INT NULL ,
  `idUserVenta` INT NULL ,
  `idImprenta` INT NULL ,
  `idCTPParent` INT NULL ,
  `tipoCTP` INT NULL ,
  PRIMARY KEY (`idCTP`) ,
  INDEX `fk_venta_cliente1` (`idCliente` ASC) ,
  INDEX `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  INDEX `fk_CTP_user1` (`idUserOT` ASC) ,
  INDEX `fk_CTP_user2` (`idUserVenta` ASC) ,
  INDEX `fk_CTP_Imprenta1` (`idImprenta` ASC) ,
  INDEX `fk_CTP_CTP1` (`idCTPParent` ASC) ,
  CONSTRAINT `fk_venta_cliente10`
    FOREIGN KEY (`idCliente` )
    REFERENCES  `cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cajaMovimientoVenta10`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES  `cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user1`
    FOREIGN KEY (`idUserOT` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user2`
    FOREIGN KEY (`idUserVenta` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_Imprenta1`
    FOREIGN KEY (`idImprenta` )
    REFERENCES  `Imprenta` (`idImprenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_CTP1`
    FOREIGN KEY (`idCTPParent` )
    REFERENCES  `CTP` (`idCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `detalleCTP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `detalleCTP` ;

CREATE  TABLE IF NOT EXISTS  `detalleCTP` (
  `idDetalleCTP` INT NOT NULL AUTO_INCREMENT ,
  `idCTP` INT NULL ,
  `idAlmacenProducto` INT NULL ,
  `nroPlacas` INT NULL ,
  `formato` VARCHAR(100) NULL ,
  `trabajo` VARCHAR(100) NULL ,
  `pinza` INT NULL ,
  `resolucion` DOUBLE NULL ,
  `costoAdicional` DOUBLE NOT NULL ,
  `costoTotal` DOUBLE NOT NULL ,
  `estado` INT NULL ,
  `C` TINYINT(1) NULL ,
  `M` TINYINT(1) NULL ,
  `Y` TINYINT(1) NULL ,
  `K` TINYINT(1) NULL ,
  PRIMARY KEY (`idDetalleCTP`) ,
  INDEX `fk_detalleCTP_CTP1` (`idCTP` ASC) ,
  INDEX `fk_detalleCTP_almacenProducto1` (`idAlmacenProducto` ASC) ,
  CONSTRAINT `fk_detalleCTP_CTP1`
    FOREIGN KEY (`idCTP` )
    REFERENCES  `CTP` (`idCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleCTP_almacenProducto1`
    FOREIGN KEY (`idAlmacenProducto` )
    REFERENCES  `almacenProducto` (`idAlmacenProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `cajaChica`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `cajaChica` ;

CREATE  TABLE IF NOT EXISTS  `cajaChica` (
  `idcajaChica` INT NOT NULL AUTO_INCREMENT ,
  `idUser` INT NULL ,
  `idCaja` INT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `maximo` DOUBLE NULL ,
  `descripcion` VARCHAR(50) NULL ,
  PRIMARY KEY (`idcajaChica`) ,
  INDEX `fk_cajaChica_caja1` (`idCaja` ASC) ,
  INDEX `fk_cajaChica_user1` (`idUser` ASC) ,
  CONSTRAINT `fk_cajaChica_caja1`
    FOREIGN KEY (`idCaja` )
    REFERENCES  `caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaChica_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES  `user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `TipoMovimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `TipoMovimiento` ;

CREATE  TABLE IF NOT EXISTS  `TipoMovimiento` (
  `idTipoMovimiento` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `estado` INT NOT NULL ,
  PRIMARY KEY (`idTipoMovimiento`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `cajaChicaMovimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `cajaChicaMovimiento` ;

CREATE  TABLE IF NOT EXISTS  `cajaChicaMovimiento` (
  `idcajaChicaMovimiento` INT NOT NULL AUTO_INCREMENT ,
  `idUser` INT NULL ,
  `idTipoMovimiento` INT NULL ,
  `monto` DOUBLE NOT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `fechaMovimiento` DATETIME NOT NULL ,
  `tipoMovimiento` INT NULL ,
  `idcajaChica` INT NULL ,
  PRIMARY KEY (`idcajaChicaMovimiento`) ,
  INDEX `fk_cajaChicaMovimiento_cajaChica1` (`idcajaChica` ASC) ,
  INDEX `fk_cajaChicaMovimiento_TipoMovimiento1` (`tipoMovimiento` ASC) ,
  CONSTRAINT `fk_cajaChicaMovimiento_cajaChica1`
    FOREIGN KEY (`idcajaChica` )
    REFERENCES  `cajaChica` (`idcajaChica` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaChicaMovimiento_TipoMovimiento1`
    FOREIGN KEY (`tipoMovimiento` )
    REFERENCES  `TipoMovimiento` (`idTipoMovimiento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  `cajaChicaTipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS  `cajaChicaTipo` ;

CREATE  TABLE IF NOT EXISTS  `cajaChicaTipo` (
  `idcajaChicaTipo` INT NOT NULL AUTO_INCREMENT ,
  `idcajaChica` INT NOT NULL ,
  `idTipoMovimiento` INT NOT NULL ,
  PRIMARY KEY (`idcajaChicaTipo`) ,
  INDEX `fk_cajaChicaTipo_TipoMovimiento1` (`idTipoMovimiento` ASC) ,
  INDEX `fk_cajaChicaTipo_cajaChica1` (`idcajaChica` ASC) ,
  CONSTRAINT `fk_cajaChicaTipo_TipoMovimiento1`
    FOREIGN KEY (`idTipoMovimiento` )
    REFERENCES  `TipoMovimiento` (`idTipoMovimiento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaChicaTipo_cajaChica1`
    FOREIGN KEY (`idcajaChica` )
    REFERENCES  `cajaChica` (`idcajaChica` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
