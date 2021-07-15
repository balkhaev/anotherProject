<?php
class Item
{
    private $conn;
    private $table_name = "items";

    public $uid;
    public $bsgId;
    public $name;
    public $shortName;
    public $price;
    public $basePrice;
    public $avg24hPrice;
    public $avg7daysPrice;
    public $traderName;
    public $traderPrice;
    public $traderPriceCur;
    public $updated;
    public $slots;
    public $diff24h;
    public $diff7days;
    public $icon;
    public $link;
    public $wikiLink;
    public $img;
    public $imgBig;
    public $referance;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function exists()
    {
        $query = "SELECT uid, name, shortName, price, basePrice, avg24hPrice, avg7daysPrice, traderName, traderPrice, traderPriceCur, updated, slots, diff24h, diff7days, icon, link, wikiLink, img, imgBig, referance
                FROM " . $this->table_name . "
                WHERE name = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(1, $this->name);

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->uid = $row['uid'];
            $this->name = $row['name'];
            $this->shortName = $row['shortName'];
            $this->price = $row['price'];
            $this->basePrice = $row['basePrice'];
            $this->avg24hPrice = $row['avg24hPrice'];
            $this->avg7daysPrice = $row['avg7daysPrice'];
            $this->traderName = $row['traderName'];
            $this->traderPrice = $row['traderPrice'];
            $this->traderPriceCur = $row['traderPriceCur'];
            $this->updated = $row['updated'];
            $this->slots = $row['slots'];
            $this->diff24h = $row['diff24h'];
            $this->diff7days = $row['diff7days'];
            $this->icon = $row['icon'];
            $this->link = $row['link'];
            $this->wikiLink = $row['wikiLink'];
            $this->img = $row['img'];
            $this->imgBig = $row['imgBig'];
            $this->referance = $row['referance'];

            return true;
        }

        return false;
    }

    function toArray()
    {
        return [
            "uid" => $this->uid,
            "name" => $this->name,
            "shortName" => $this->shortName,
            "price" => $this->price,
            "basePrice" => $this->basePrice,
            "avg24hPrice" => $this->avg24hPrice,
            "avg7daysPrice" => $this->avg7daysPrice,
            "traderName" => $this->traderName,
            "traderPrice" => $this->traderPrice,
            "traderPriceCur" => $this->traderPriceCur,
            "updated" => $this->updated,
            "slots" => $this->slots,
            "diff24h" => $this->diff24h,
            "diff7days" => $this->diff7days,
            "icon" => $this->icon,
            "link" => $this->link,
            "wikiLink" => $this->wikiLink,
            "img" => $this->img,
            "imgBig" => $this->imgBig,
            "referance" => $this->referance,
        ];
    }
}
