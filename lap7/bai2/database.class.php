<?php
class Dao {
    private $con;

    // Hàm khởi tạo kết nối CSDL (chú ý: 2 dấu gạch dưới __construct)
    function __construct($user, $pass, $db) {
        $host = $_SERVER['SERVER_NAME'];
        $this->con = mysqli_connect($host, $user, $pass, $db);
    }

    // Phương thức thực thi câu truy vấn
    public function query($sql) {
        mysqli_query($this->con, "SET NAMES 'utf8'");
        $rs = mysqli_query($this->con, $sql);
        return $rs;
    }

    // Phương thức tự động tạo bảng HTML từ kết quả truy vấn
    function table($sql, $header) {
        $rs = $this->query($sql);
        $fieldinfo = mysqli_fetch_fields($rs);
        $str = "<table border='1' cellpadding='5' cellspacing='0'><tr>";

        // Tạo dòng tiêu đề cột từ tên các trường
        foreach ($fieldinfo as $val) {
            $name = $val->name;
            $str .= "<th>" . $name . "</th>";
        }
        $str .= "</tr>";

        // Đưa dữ liệu từng dòng vào bảng
        while ($r = mysqli_fetch_array($rs)) {
            $str .= "<tr>";
            foreach ($fieldinfo as $val) {
                $name = $val->name;
                $str .= "<td>" . $r[$name] . "</td>";
            }
            $str .= "</tr>";
        }
        $str .= "</table>";

        echo "<h3>{$header}</h3>";
        echo $str;
    }
}
?>