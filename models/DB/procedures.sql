USE sales;

DELIMITER $$
CREATE PROCEDURE getDetails(idSale INT)
BEGIN
SELECT
  d.id, p.name, p.price, d.amount, d.sub_total
FROM
  detail d
INNER JOIN
  product p
ON
  p.id = d.product_id
WHERE
  d.sale_id = idSale;
END $$ DELIMITER ;

DELIMITER //
CREATE PROCEDURE createSale(total INT)
BEGIN
  INSERT INTO sale VALUES(null, NOW(), total);
END // DELIMITER ;

DELIMITER //
CREATE PROCEDURE createDetail(productId INT, amount INT, subTotal INT)
BEGIN
  DECLARE lastSailId INT;
  SET lastSailId = (SELECT getMaxSaleId());
  INSERT INTO detail VALUES(null, lastSailId, productId, amount, subTotal);
  CALL updateStock(productId, amount);
END // DELIMITER ;

DELIMITER //
CREATE FUNCTION getMaxSaleId() RETURNS INT
BEGIN
  DECLARE res INT;
  SET res = (SELECT MAX(id) FROM sale);
  RETURN res;
END // DELIMITER ;

DELIMITER //
CREATE FUNCTION getCurrentStock(productId INT) RETURNS INT
BEGIN
  RETURN (SELECT stock FROM product WHERE id = productId);
END // DELIMITER ;

DELIMITER //
CREATE PROCEDURE updateStock(productId INT, stockToDiscount INT)
BEGIN
  DECLARE currStock INT;
  DECLARE newStock INT;
  SET currStock = (SELECT getCurrentStock(productId));
  SET newStock = (currStock - stockToDiscount);
  UPDATE product SET stock = newStock WHERE id = productId;
END // DELIMITER ;
