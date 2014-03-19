CREATE VIEW `bookings_view`
AS
SELECT bookingdetails.*,packagetours.title
FROM bookingdetails
INNER JOIN packagetours
ON bookingdetails.package_id=packagetours.package_id
ORDER BY bookingdetails.id;

