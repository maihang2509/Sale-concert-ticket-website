        let tongall = 0;
        let arr = [];

        function addphay(so) {
            let x;
            let nhan = "";
            let dau = so.length % 3; 
            for(let i = 0; i < (so.length - 2); i++) {
                let j = i + 3;
                x = so.substr(-j, 3);
                if(nhan != "") {
                    nhan = x + "," + nhan;
                }
                else {
                    nhan = x;
                }
                i += 2;
            }
            if(dau != 0) {
                x = so.substr(0, dau);
                nhan = x + "," + nhan;
            }
            return nhan;
        }

        function addinfo(y, sl, z, g) {
            //thêm vào thông tin đặt vé
            let info = document.getElementById("list-group");
            let before = document.getElementById("tong");
            let id_ten = 'danten' + y;
            let id_so = 'danso' + y;
            let tong = sl * parseInt(g);
            arr[y] = tong;
            let li_id = 'list-group-item' + y;
            if(document.getElementById(id_ten) == null && document.getElementById(id_so) == null) {
                let li = document.createElement("li"); //tạo thẻ <li>
                li.classList.add("list-group-item"); // thêm class cho thẻ
                li.classList.add("nd");
                li.setAttribute("id", li_id);  //thêm id cho thẻ
                let nav = document.createElement("nav");
                nav.classList.add("nav");
                let nav_id = 'nav' + y;
                nav.setAttribute("id", nav_id);
                li.appendChild(nav);  //đưa thẻ nav thành thẻ con của li
                info.insertBefore(li, before); //đặt thông tin đằng truoc thẻ có id=tong
                let li2_1 = '<li class="nav-link khung2-cot1" id="' + id_ten + '"></li>';
                let li2_2 = '<li class="nav-link khung2-cot2" id="' + id_so + '"></li>';
                document.getElementById(nav_id).innerHTML += li2_1;
                document.getElementById(nav_id).innerHTML += li2_2;
            }
            if(document.getElementById(y).value > 0) {
                document.getElementById(id_so).innerHTML = sl + '<br>' + addphay(tong.toString());
                document.getElementById(id_ten).innerHTML = z + '<br>' + addphay(g.toString());;
            }
            else { //xóa dòng
                info.removeChild(document.getElementById(li_id));
            }
            //tong gia tien
            for(let j = 1; j < arr.length; j++) {
                if(arr[j] == null) {  // nếu vé giữa không được chọn thì cho giá vé = 0
                    arr[j] = 0;
                }
                tongall += arr[j];
            }
            document.getElementById("tinhtong").innerHTML = addphay(tongall.toString()) + " VND";
            tongall = 0;
        }

        function addform(y, sl) {   //dua thong tin vao database
            let form = document.getElementById("thaotac");
            let id_new = 've' + y;
            document.getElementById(id_new).value = sl;
        }

        function setsl(x, y, z, g) {
            let i = document.getElementById(y).value;
            let a;
            if(x == "+") {
                document.getElementById(y).value ++;
            }
            if(x == "-" && i > 0) {
                document.getElementById(y).value --;
            }
            let sl = document.getElementById(y).value;
            console.log(sl);
            addform(y, sl);
            addinfo(y, sl, z, g);
        }