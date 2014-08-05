SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `singular` DEFAULT CHARACTER SET latin1 ;
USE `singular` ;

-- -----------------------------------------------------
-- Table `singular`.`empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`empleado` ;

CREATE  TABLE IF NOT EXISTS `singular`.`empleado` (
  `idEmpleado` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(40) NULL DEFAULT NULL ,
  `apellido` VARCHAR(40) NULL DEFAULT NULL ,
  `fechaRegistro` DATETIME NULL DEFAULT NULL ,
  `email` VARCHAR(50) NULL DEFAULT NULL ,
  `telefono` VARCHAR(20) NULL DEFAULT NULL ,
  `ci` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idEmpleado`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`user` ;

CREATE  TABLE IF NOT EXISTS `singular`.`user` (
  `idUser` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NULL DEFAULT NULL ,
  `password` VARCHAR(150) NULL DEFAULT NULL ,
  `fechaLogin` DATETIME NULL DEFAULT NULL ,
  `estado` INT(11) NULL DEFAULT NULL ,
  `tipo` VARCHAR(10) NULL DEFAULT NULL ,
  `idEmpleado` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idUser`) ,
  INDEX `fk_user_empleado1` (`idEmpleado` ASC) ,
  CONSTRAINT `fk_user_empleado1`
    FOREIGN KEY (`idEmpleado` )
    REFERENCES `singular`.`empleado` (`idEmpleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`caja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`caja` ;

CREATE  TABLE IF NOT EXISTS `singular`.`caja` (
  `idCaja` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `idParent` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCaja`) ,
  INDEX `fk_caja_caja1` (`idParent` ASC) ,
  CONSTRAINT `fk_caja_caja1`
    FOREIGN KEY (`idParent` )
    REFERENCES `singular`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cajaMovimientoVenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cajaMovimientoVenta` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cajaMovimientoVenta` (
  `idCajaMovimientoVenta` INT(11) NOT NULL AUTO_INCREMENT ,
  `idUser` INT(11) NULL DEFAULT NULL ,  
  `monto` DOUBLE NOT NULL ,
  `motivo` VARCHAR(100) NOT NULL ,
  `fechaMovimiento` DATETIME NULL DEFAULT NULL ,
  `tipo` INT(11) NOT NULL ,
  `arqueo` INT(11) NULL DEFAULT NULL ,
  `idCaja` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCajaMovimientoVenta`) ,
  INDEX `fk_movimientoCaja_user1` (`idUser` ASC) ,
  INDEX `fk_cajaMovimientoVenta_caja1` (`idCaja` ASC) ,
  CONSTRAINT `fk_cajaMovimientoVenta_caja1`
    FOREIGN KEY (`idCaja` )
    REFERENCES `singular`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoCaja_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 45
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`TiposClientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`TiposClientes` ;

CREATE  TABLE IF NOT EXISTS `singular`.`TiposClientes` (
  `idTiposClientes` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`idTiposClientes`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cliente` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cliente` (
  `idCliente` INT(11) NOT NULL AUTO_INCREMENT ,
  `nitCi` VARCHAR(20) NULL DEFAULT NULL ,
  `apellido` VARCHAR(40) NULL DEFAULT NULL ,
  `nombre` VARCHAR(40) NULL DEFAULT NULL ,
  `correo` VARCHAR(50) NULL DEFAULT NULL ,
  `fechaRegistro` DATETIME NULL DEFAULT NULL ,
  `telefono` VARCHAR(20) NULL DEFAULT NULL ,
  `direccion` VARCHAR(100) NULL DEFAULT NULL ,
  `idTiposClientes` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCliente`) ,
  INDEX `fk_cliente_TiposClientes1` (`idTIposClientes` ASC) ,
  CONSTRAINT `fk_cliente_TiposClientes1`
    FOREIGN KEY (`idTIposClientes` )
    REFERENCES `singular`.`TiposClientes` (`idTiposClientes` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`Imprenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`Imprenta` ;

CREATE  TABLE IF NOT EXISTS `singular`.`Imprenta` (
  `idImprenta` INT(11) NOT NULL AUTO_INCREMENT ,
  `fechaOrden` DATETIME NULL DEFAULT NULL ,
  `tipoOrden` INT(11) NULL DEFAULT NULL ,
  `formaPago` INT(11) NULL DEFAULT NULL ,
  `idCliente` INT(11) NULL DEFAULT NULL ,
  `fechaPlazo` DATETIME NULL DEFAULT NULL ,
  `codigo` VARCHAR(45) NULL DEFAULT NULL ,
  `serie` INT(11) NULL DEFAULT NULL ,
  `montoVenta` DOUBLE NOT NULL ,
  `montoPagado` DOUBLE NOT NULL ,
  `montoCambio` DOUBLE NOT NULL ,
  `montoDescuento` DOUBLE NOT NULL ,
  `estado` INT(11) NOT NULL ,
  `factura` VARCHAR(50) NULL DEFAULT NULL ,
  `autorizado` VARCHAR(50) NULL DEFAULT NULL ,
  `responsable` VARCHAR(50) NULL DEFAULT NULL ,
  `obs` VARCHAR(200) NULL DEFAULT NULL ,
  `idCajaMovimientoVenta` INT(11) NULL DEFAULT NULL ,
  `numero` INT(11) NULL DEFAULT NULL ,
  `idUserOT` INT(11) NOT NULL ,
  `idUserVenta` INT(11) NOT NULL ,
  PRIMARY KEY (`idImprenta`) ,
  INDEX `fk_venta_cliente1` (`idCliente` ASC) ,
  INDEX `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  INDEX `fk_CTP_user1` (`idUserOT` ASC) ,
  INDEX `fk_CTP_user2` (`idUserVenta` ASC) ,
  CONSTRAINT `fk_CTP_user10`
    FOREIGN KEY (`idUserOT` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user20`
    FOREIGN KEY (`idUserVenta` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cajaMovimientoVenta100`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES `singular`.`cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cliente100`
    FOREIGN KEY (`idCliente` )
    REFERENCES `singular`.`cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`CTP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`CTP` ;

CREATE  TABLE IF NOT EXISTS `singular`.`CTP` (
  `idCTP` INT(11) NOT NULL AUTO_INCREMENT ,
  `fechaOrden` DATETIME NULL DEFAULT NULL ,
  `tipoOrden` INT(11) NULL DEFAULT NULL ,
  `formaPago` INT(11) NULL DEFAULT NULL ,
  `idCliente` INT(11) NULL DEFAULT NULL ,
  `fechaPlazo` DATETIME NULL DEFAULT NULL ,
  `codigo` VARCHAR(45) NULL DEFAULT NULL ,
  `serie` INT(11) NULL DEFAULT NULL ,
  `numero` INT(11) NULL DEFAULT NULL ,
  `montoVenta` DOUBLE NOT NULL ,
  `montoPagado` DOUBLE NOT NULL ,
  `montoCambio` DOUBLE NOT NULL ,
  `montoDescuento` DOUBLE NOT NULL ,
  `estado` INT(11) NOT NULL ,
  `factura` VARCHAR(50) NULL DEFAULT NULL ,
  `autorizado` VARCHAR(50) NULL DEFAULT NULL ,
  `responsable` VARCHAR(50) NULL DEFAULT NULL ,
  `obs` VARCHAR(200) NULL DEFAULT NULL ,
  `idCajaMovimientoVenta` INT(11) NULL DEFAULT NULL ,
  `idUserOT` INT(11) NULL DEFAULT NULL ,
  `idUserVenta` INT(11) NULL DEFAULT NULL ,
  `idImprenta` INT(11) NULL DEFAULT NULL ,
  `idCTPParent` INT(11) NULL DEFAULT NULL ,
  `tipoCTP` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCTP`) ,
  INDEX `fk_venta_cliente1` (`idCliente` ASC) ,
  INDEX `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  INDEX `fk_CTP_user1` (`idUserOT` ASC) ,
  INDEX `fk_CTP_user2` (`idUserVenta` ASC) ,
  INDEX `fk_CTP_Imprenta1` (`idImprenta` ASC) ,
  INDEX `fk_CTP_CTP1` (`idCTPParent` ASC) ,
  CONSTRAINT `fk_CTP_CTP1`
    FOREIGN KEY (`idCTPParent` )
    REFERENCES `singular`.`CTP` (`idCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_Imprenta1`
    FOREIGN KEY (`idImprenta` )
    REFERENCES `singular`.`Imprenta` (`idImprenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user1`
    FOREIGN KEY (`idUserOT` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CTP_user2`
    FOREIGN KEY (`idUserVenta` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cajaMovimientoVenta10`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES `singular`.`cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cliente10`
    FOREIGN KEY (`idCliente` )
    REFERENCES `singular`.`cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cantidadCTP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cantidadCTP` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cantidadCTP` (
  `idCantidadCTP` INT(11) NOT NULL ,
  `Inicio` INT(11) NULL DEFAULT NULL ,
  `final` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idCantidadCTP`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`horario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`horario` ;

CREATE  TABLE IF NOT EXISTS `singular`.`horario` (
  `idHorario` INT(11) NOT NULL ,
  `inicio` TIME NULL DEFAULT NULL ,
  `final` TIME NULL DEFAULT NULL ,
  `prioridad` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idHorario`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`MatrizPreciosCTP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`MatrizPreciosCTP` ;

CREATE  TABLE IF NOT EXISTS `singular`.`MatrizPreciosCTP` (
  `idMatrizPreciosCTP` INT(11) NOT NULL AUTO_INCREMENT ,
  `idTiposClientes` INT(11) NULL DEFAULT NULL ,
  `idHorario` INT(11) NULL DEFAULT NULL ,
  `idCantidad` INT(11) NULL DEFAULT NULL ,
  `precioSF` DOUBLE NOT NULL ,
  `precioCF` DOUBLE NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  PRIMARY KEY (`idMatrizPreciosCTP`) ,
  INDEX `fk_MatrizPreciosCTP_horario1` (`idHorario` ASC) ,
  INDEX `fk_MatrizPreciosCTP_cantidadCTP1` (`idCantidad` ASC) ,
  INDEX `fk_MatrizPreciosCTP_TiposClientes1` (`idTiposClientes` ASC) ,
  CONSTRAINT `fk_MatrizPreciosCTP_cantidadCTP1`
    FOREIGN KEY (`idCantidad` )
    REFERENCES `singular`.`cantidadCTP` (`idCantidadCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MatrizPreciosCTP_horario1`
    FOREIGN KEY (`idHorario` )
    REFERENCES `singular`.`horario` (`idHorario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MatrizPreciosCTP_TiposClientes1`
    FOREIGN KEY (`idTiposClientes` )
    REFERENCES `singular`.`TiposClientes` (`idTiposClientes` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`TipoMovimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`TipoMovimiento` ;

CREATE  TABLE IF NOT EXISTS `singular`.`TipoMovimiento` (
  `idTipoMovimiento` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `estado` INT(11) NOT NULL ,
  PRIMARY KEY (`idTipoMovimiento`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`almacen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`almacen` ;

CREATE  TABLE IF NOT EXISTS `singular`.`almacen` (
  `idAlmacen` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(20) NULL DEFAULT NULL ,
  `idParent` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idAlmacen`) ,
  INDEX `fk_almacen_almacen1` (`idParent` ASC) ,
  CONSTRAINT `fk_almacen_almacen1`
    FOREIGN KEY (`idParent` )
    REFERENCES `singular`.`almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`producto` ;

CREATE  TABLE IF NOT EXISTS `singular`.`producto` (
  `idProducto` INT(11) NOT NULL AUTO_INCREMENT ,
  `idMatrizPrecios` INT(11) NULL ,
  `codigo` VARCHAR(40) NOT NULL ,
  `material` VARCHAR(40) NOT NULL ,
  `color` VARCHAR(40) NOT NULL ,
  `marca` VARCHAR(40) NOT NULL ,
  `industria` VARCHAR(40) NOT NULL ,
  `cantXPaquete` INT(11) NOT NULL ,
  `precioSFU` DOUBLE NOT NULL ,
  `precioSFP` DOUBLE NOT NULL ,
  `precioCFU` DOUBLE NOT NULL ,
  `precioCFP` DOUBLE NOT NULL ,
  `familia` VARCHAR(40) NOT NULL ,
  `detalle` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idProducto`) ,
  INDEX `fk_producto_MatrizPreciosCTP1` (`idMatrizPrecios` ASC) ,
  CONSTRAINT `fk_producto_MatrizPreciosCTP1`
    FOREIGN KEY (`idMatrizPrecios` )
    REFERENCES `singular`.`MatrizPreciosCTP` (`idMatrizPreciosCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 182
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`almacenProducto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`almacenProducto` ;

CREATE  TABLE IF NOT EXISTS `singular`.`almacenProducto` (
  `idAlmacenProducto` INT(11) NOT NULL AUTO_INCREMENT ,
  `idProducto` INT(11) NULL DEFAULT NULL ,
  `stockU` INT(11) NULL DEFAULT NULL ,
  `stockP` INT(11) NULL DEFAULT NULL ,
  `idAlmacen` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idAlmacenProducto`) ,
  INDEX `fk_almacenProducto_producto1` (`idProducto` ASC) ,
  INDEX `fk_almacenProducto_almacen1` (`idAlmacen` ASC) ,
  CONSTRAINT `fk_almacenProducto_almacen1`
    FOREIGN KEY (`idAlmacen` )
    REFERENCES `singular`.`almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacenProducto_producto1`
    FOREIGN KEY (`idProducto` )
    REFERENCES `singular`.`producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 705
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`banner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`banner` ;

CREATE  TABLE IF NOT EXISTS `singular`.`banner` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `imagen` VARCHAR(500) NOT NULL ,
  `texto` VARCHAR(1000) NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `order` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cajaArqueo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cajaArqueo` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cajaArqueo` (
  `idCajaArqueo` INT(11) NOT NULL AUTO_INCREMENT ,
  `idCaja` INT(11) NULL DEFAULT NULL ,
  `idUser` INT(11) NULL DEFAULT NULL ,
  `monto` DOUBLE NOT NULL ,
  `fechaArqueo` DATETIME NULL DEFAULT NULL ,
  `fechaVentas` DATETIME NULL DEFAULT NULL ,
  `comprobante` VARCHAR(20) NULL DEFAULT NULL ,
  `saldo` DOUBLE NOT NULL ,
  PRIMARY KEY (`idCajaArqueo`) ,
  INDEX `fk_cajaVenta_caja1` (`idCaja` ASC) ,
  INDEX `fk_cajaVenta_user1` (`idUser` ASC) ,
  CONSTRAINT `fk_cajaVenta_caja1`
    FOREIGN KEY (`idCaja` )
    REFERENCES `singular`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaVenta_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cajaChica`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cajaChica` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cajaChica` (
  `idcajaChica` INT(11) NOT NULL AUTO_INCREMENT ,
  `idUser` INT(11) NULL DEFAULT NULL ,
  `idCaja` INT(11) NULL DEFAULT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `maximo` DOUBLE NULL DEFAULT NULL ,
  `detalle` VARCHAR(50) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcajaChica`) ,
  INDEX `fk_cajaChica_caja1` (`idCaja` ASC) ,
  INDEX `fk_cajaChica_user1` (`idUser` ASC) ,
  CONSTRAINT `fk_cajaChica_caja1`
    FOREIGN KEY (`idCaja` )
    REFERENCES `singular`.`caja` (`idCaja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaChica_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cajaChicaMovimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cajaChicaMovimiento` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cajaChicaMovimiento` (
  `idcajaChicaMovimiento` INT(11) NOT NULL AUTO_INCREMENT ,
  `idUser` INT(11) NULL DEFAULT NULL ,
  `idTipoMovimiento` INT(11) NULL DEFAULT NULL ,
  `monto` DOUBLE NOT NULL ,
  `saldo` DOUBLE NOT NULL ,
  `fechaMovimiento` DATETIME NOT NULL ,
  `tipoMovimiento` INT(11) NULL DEFAULT NULL ,
  `idcajaChica` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idcajaChicaMovimiento`) ,
  INDEX `fk_cajaChicaMovimiento_cajaChica1` (`idcajaChica` ASC) ,
  INDEX `fk_cajaChicaMovimiento_TipoMovimiento1` (`tipoMovimiento` ASC) ,
  CONSTRAINT `fk_cajaChicaMovimiento_cajaChica1`
    FOREIGN KEY (`idcajaChica` )
    REFERENCES `singular`.`cajaChica` (`idcajaChica` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaChicaMovimiento_TipoMovimiento1`
    FOREIGN KEY (`tipoMovimiento` )
    REFERENCES `singular`.`TipoMovimiento` (`idTipoMovimiento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`cajaChicaTipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`cajaChicaTipo` ;

CREATE  TABLE IF NOT EXISTS `singular`.`cajaChicaTipo` (
  `idcajaChicaTipo` INT(11) NOT NULL AUTO_INCREMENT ,
  `idcajaChica` INT(11) NOT NULL ,
  `idTipoMovimiento` INT(11) NOT NULL ,
  PRIMARY KEY (`idcajaChicaTipo`) ,
  INDEX `fk_cajaChicaTipo_TipoMovimiento1` (`idTipoMovimiento` ASC) ,
  INDEX `fk_cajaChicaTipo_cajaChica1` (`idcajaChica` ASC) ,
  CONSTRAINT `fk_cajaChicaTipo_cajaChica1`
    FOREIGN KEY (`idcajaChica` )
    REFERENCES `singular`.`cajaChica` (`idcajaChica` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cajaChicaTipo_TipoMovimiento1`
    FOREIGN KEY (`idTipoMovimiento` )
    REFERENCES `singular`.`TipoMovimiento` (`idTipoMovimiento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`detalleCTP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`detalleCTP` ;

CREATE  TABLE IF NOT EXISTS `singular`.`detalleCTP` (
  `idDetalleCTP` INT(11) NOT NULL AUTO_INCREMENT ,
  `idCTP` INT(11) NULL DEFAULT NULL ,
  `idAlmacenProducto` INT(11) NULL DEFAULT NULL ,
  `nroPlacas` INT(11) NULL DEFAULT NULL ,
  `formato` VARCHAR(50) NULL DEFAULT NULL ,
  `trabajo` VARCHAR(100) NULL DEFAULT NULL ,
  `pinza` INT(11) NULL DEFAULT NULL ,
  `resolucion` DOUBLE NULL DEFAULT NULL ,
  `costoAdicional` DOUBLE NOT NULL ,
  `costoTotal` DOUBLE NOT NULL ,
  `estado` INT(11) NULL DEFAULT NULL ,
  `C` TINYINT(1) NULL DEFAULT NULL ,
  `M` TINYINT(1) NULL DEFAULT NULL ,
  `Y` TINYINT(1) NULL DEFAULT NULL ,
  `K` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`idDetalleCTP`) ,
  INDEX `fk_detalleCTP_CTP1` (`idCTP` ASC) ,
  INDEX `fk_detalleCTP_almacenProducto1` (`idAlmacen` ASC) ,
  CONSTRAINT `fk_detalleCTP_CTP1`
    FOREIGN KEY (`idCTP` )
    REFERENCES `singular`.`CTP` (`idCTP` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleCTP_almacenProducto1`
    FOREIGN KEY (`idAlmacen` )
    REFERENCES `singular`.`almacenProducto` (`idAlmacenProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`venta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`venta` ;

CREATE  TABLE IF NOT EXISTS `singular`.`venta` (
  `idVenta` INT(11) NOT NULL AUTO_INCREMENT ,
  `fechaVenta` DATETIME NULL DEFAULT NULL ,
  `tipoVenta` INT(11) NULL DEFAULT NULL ,
  `formaPago` INT(11) NULL DEFAULT NULL ,
  `idCliente` INT(11) NULL DEFAULT NULL ,
  `fechaPlazo` DATETIME NULL DEFAULT NULL ,
  `codigo` VARCHAR(45) NULL DEFAULT NULL ,
  `numero` INT(11) NOT NULL ,
  `serie` INT(11) NULL DEFAULT NULL ,
  `montoVenta` DOUBLE NULL DEFAULT NULL ,
  `montoPagado` DOUBLE NULL DEFAULT NULL ,
  `montoCambio` DOUBLE NULL DEFAULT NULL ,
  `montoDescuento` DOUBLE NULL DEFAULT NULL ,
  `estado` INT(11) NULL DEFAULT NULL ,
  `factura` VARCHAR(50) NULL DEFAULT NULL ,
  `autorizado` VARCHAR(50) NULL DEFAULT NULL ,
  `responsable` VARCHAR(50) NULL DEFAULT NULL ,
  `obs` VARCHAR(200) NULL DEFAULT NULL ,
  `idCajaMovimientoVenta` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idVenta`) ,
  INDEX `fk_venta_cliente1` (`idCliente` ASC) ,
  INDEX `fk_venta_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  CONSTRAINT `fk_venta_cajaMovimientoVenta1`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES `singular`.`cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES `singular`.`cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 37
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`detalleVenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`detalleVenta` ;

CREATE  TABLE IF NOT EXISTS `singular`.`detalleVenta` (
  `idDetalleVenta` INT(11) NOT NULL AUTO_INCREMENT ,
  `idVenta` INT(11) NULL DEFAULT NULL ,
  `cantidadU` INT(11) NOT NULL ,
  `costoU` DOUBLE NOT NULL ,
  `cantidadP` INT(11) NOT NULL ,
  `costoP` DOUBLE NOT NULL ,
  `costoAdicional` DOUBLE NULL DEFAULT NULL ,
  `costoTotal` DOUBLE NULL DEFAULT NULL ,
  `idAlmacenProducto` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`idDetalleVenta`) ,
  INDEX `fk_detalleVenta_venta1` (`idVenta` ASC) ,
  INDEX `fk_detalleVenta_almacenProducto1` (`idAlmacenProducto` ASC) ,
  CONSTRAINT `fk_detalleVenta_almacenProducto1`
    FOREIGN KEY (`idAlmacenProducto` )
    REFERENCES `singular`.`almacenProducto` (`idAlmacenProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleVenta_venta1`
    FOREIGN KEY (`idVenta` )
    REFERENCES `singular`.`venta` (`idVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`movimientoAlmacen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`movimientoAlmacen` ;

CREATE  TABLE IF NOT EXISTS `singular`.`movimientoAlmacen` (
  `idMovimientoAlmacen` INT(11) NOT NULL AUTO_INCREMENT ,
  `idProducto` INT(11) NULL DEFAULT NULL ,
  `idAlmacenOrigen` INT(11) NULL DEFAULT NULL ,
  `idAlmacenDestino` INT(11) NULL DEFAULT NULL ,
  `cantidadU` INT(11) NULL DEFAULT NULL ,
  `cantidadP` INT(11) NULL DEFAULT NULL ,
  `idUser` INT(11) NULL DEFAULT NULL ,
  `fechaMovimiento` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`idMovimientoAlmacen`) ,
  INDEX `fk_movimientoAlmacen_producto1` (`idProducto` ASC) ,
  INDEX `fk_movimientoAlmacen_almacen1` (`idAlmacenOrigen` ASC) ,
  INDEX `fk_movimientoAlmacen_almacen2` (`idAlmacenDestino` ASC) ,
  INDEX `fk_movimientoAlmacen_user1` (`idUser` ASC) ,
  CONSTRAINT `fk_movimientoAlmacen_almacen1`
    FOREIGN KEY (`idAlmacenOrigen` )
    REFERENCES `singular`.`almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoAlmacen_almacen2`
    FOREIGN KEY (`idAlmacenDestino` )
    REFERENCES `singular`.`almacen` (`idAlmacen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoAlmacen_producto1`
    FOREIGN KEY (`idProducto` )
    REFERENCES `singular`.`producto` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientoAlmacen_user1`
    FOREIGN KEY (`idUser` )
    REFERENCES `singular`.`user` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 109
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`pages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`pages` ;

CREATE  TABLE IF NOT EXISTS `singular`.`pages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `contenido` MEDIUMTEXT NOT NULL ,
  `enable` INT(11) NOT NULL ,
  `order` INT(11) NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `singular`.`recibos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `singular`.`recibos` ;

CREATE  TABLE IF NOT EXISTS `singular`.`recibos` (
  `idRecibos` INT(11) NOT NULL AUTO_INCREMENT ,
  `categoria` VARCHAR(40) NULL DEFAULT NULL ,
  `codigo` VARCHAR(20) NULL DEFAULT NULL ,
  `idCliente` INT(11) NULL DEFAULT NULL ,
  `responsable` VARCHAR(40) NULL DEFAULT NULL ,
  `celular` VARCHAR(20) NULL DEFAULT NULL ,
  `fechaRegistro` DATETIME NULL DEFAULT NULL ,
  `concepto` VARCHAR(100) NULL DEFAULT NULL ,
  `codigoNumero` VARCHAR(20) NULL DEFAULT NULL ,
  `servicio` VARCHAR(20) NULL DEFAULT NULL ,
  `monto` DOUBLE NULL DEFAULT NULL ,
  `acuenta` DOUBLE NULL DEFAULT NULL ,
  `saldo` DOUBLE NULL DEFAULT NULL ,
  `obs` VARCHAR(200) NULL DEFAULT NULL ,
  `tipoRecivo` INT(11) NULL DEFAULT NULL ,
  `descuento` DOUBLE NULL DEFAULT NULL ,
  `idCajaMovimientoVenta` INT(11) NOT NULL ,
  PRIMARY KEY (`idRecibos`) ,
  INDEX `fk_recibos_cliente1` (`idCliente` ASC) ,
  INDEX `fk_recibos_cajaMovimientoVenta1` (`idCajaMovimientoVenta` ASC) ,
  CONSTRAINT `fk_recibos_cajaMovimientoVenta1`
    FOREIGN KEY (`idCajaMovimientoVenta` )
    REFERENCES `singular`.`cajaMovimientoVenta` (`idCajaMovimientoVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recibos_cliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES `singular`.`cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
