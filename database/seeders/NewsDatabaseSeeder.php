<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items  = [
            ['staff_id' => 1, 'highlight' => true, 'title' => 'Nước ép việt quất mang lại lợi ích gì cho sức khỏe?', 'author' => 'Dược sĩ - Nguyễn Thị Hồng Nhung', 'img' => 'vietquoc.jpg', 'abstract' => '<p><span class="text-big"><strong>Việt quất là loại quả nhỏ bé nhưng chứa đựng vô vàn dưỡng chất quý giá, đã từ lâu được
                biết đến với những lợi ích tuyệt vời cho sức khỏe. Đặc biệt, nước ép việt quất không chỉ
                thơm ngon mà còn mang đến nhiều công dụng bất ngờ. Vậy nước ép việt quất có tác dụng gì
                đối với cơ thể chúng ta?</strong></span></p>', 'content' => '<p>Nước ép việt quất là nguồn cung cấp dồi dào các chất chống oxy hóa, đặc biệt là anthocyanins. Các hợp chất
            này đóng vai trò như một lá chắn bảo vệ tế bào khỏi tổn thương do oxy hóa, giúp giảm nguy cơ mắc một số bệnh
            ung thư và các bệnh mãn tính. Theo một nghiên cứu năm 2003, một cốc quả việt quất chứa đến 9.019 chất chống
            oxy hóa, trong khi quả việt quất hoang dã thậm chí còn có nhiều hơn với 13.427 chất. Nước ép việt quất giúp
            tăng cường hệ thống miễn dịch. Các vitamin và khoáng chất có trong việt quất, cùng với flavonoid, giúp cải
            thiện chức năng miễn dịch và hỗ trợ quá trình phục hồi cơ bắp. Nước ép việt quất có khả năng hạn chế tốc độ
            lão hóa và cải thiện chức năng nhận thức. Chất chống oxy hóa trong việt quất bảo vệ tế bào não khỏi tổn
            thương, hỗ trợ quá trình truyền dẫn tín hiệu giữa các tế bào thần kinh. Các flavonoid, đặc biệt là
            anthocyanins, có tác dụng làm tăng cường trí nhớ và khả năng học tập. Nước ép việt quất cũng góp phần vào
            việc duy trì sự trao đổi chất lành mạnh. Hàm lượng kali và mangan trong nước ép này hỗ trợ quá trình chuyển
            hóa năng lượng trong cơ thể. Kali giúp điều chỉnh mức insulin và ngăn ngừa tình trạng kháng insulin, trong
            khi mangan hỗ trợ sự hấp thu các loại vitamin cần thiết cho cơ thể, đặc biệt là thiamine.Nước ép việt quất
            cũng có tác dụng tích cực đối với sức khỏe tim mạch. Các nghiên cứu đã chỉ ra rằng việc tiêu thụ việt quất
            có thể làm giảm mức cholesterol LDL, loại cholesterol xấu, đồng thời cải thiện lưu thông máu. Anthocyanins
            trong nước ép việt quất giúp bảo vệ thành mạch máu, ngăn ngừa sự hình thành các mảng bám động mạch, từ đó
            giảm nguy cơ mắc bệnh tim mạch.Mặc dù nước ép việt quất mang lại nhiều lợi ích sức khỏe, nhưng không phải ai
            cũng phù hợp để sử dụng. Dưới đây là một số nhóm người nên cẩn trọng hoặc hạn chế tiêu thụ nước ép việt
            quất:

            Người bị dị ứng: Những người có tiền sử dị ứng với quả việt quất hoặc các loại quả mọng khác nên tránh tiêu
            thụ nước ép này. Triệu chứng dị ứng có thể bao gồm phát ban, ngứa, hoặc sưng tấy.
            Người bị tiểu đường: Dù nước ép việt quất có chứa ít đường hơn một số loại nước ép trái cây khác, nhưng nó
            vẫn chứa đường tự nhiên. Người mắc bệnh tiểu đường nên theo dõi lượng đường tiêu thụ hàng ngày và có thể cần
            tham khảo ý kiến bác sĩ trước khi bổ sung nước ép việt quất vào chế độ ăn.
            Người đang dùng thuốc chống đông máu: Việt quất có thể ảnh hưởng đến tác dụng của một số loại thuốc chống
            đông máu, do chúng chứa vitamin K, có thể tác động đến khả năng đông máu.
            Người có vấn đề về dạ dày: Nước ép việt quất có thể gây khó chịu cho dạ dày hoặc ruột ở những người có tình
            trạng tiêu hóa nhạy cảm hoặc mắc các vấn đề như hội chứng ruột kích thích (IBS). Nếu gặp triệu chứng khó
            chịu sau khi uống, nên giảm lượng tiêu thụ hoặc ngừng sử dụng.
            Nước ép việt quất không chỉ là một thức uống thơm ngon mà còn mang lại nhiều lợi ích sức khỏe đáng chú ý.
            Tuy nhiên, để tận dụng tối đa những lợi ích này, bạn cần sử dụng nước ép việt quất một cách hợp lý và cân
            nhắc đến các đối tượng không nên sử dụng. Hãy thêm nước ép việt quất vào chế độ ăn uống hàng ngày của bạn
            như một phần của lối sống lành mạnh. </p>',],
            ['staff_id' => 1, 'highlight' => true, 'title' => 'Bữa sáng giàu canxi và vitamin D tốt cho xương', 'author' => 'Dược sĩ - Nguyễn Kim Khánh', 'img' => 'buasang.jpg', 'abstract' => '<p><span class="text-big"><strong>Theo các nghiên cứu gần đây, hơn 90% canxi trong cơ thể chúng ta tập trung ở xương và răng. Điều này cho
                thấy, canxi đóng vai trò vô cùng quan trọng trong việc xây dựng và duy trì hệ xương chắc khỏe. Vậy làm
                thế nào để bổ sung đủ canxi cho cơ thể? Câu trả lời nằm ngay trong bữa sáng của bạn!</strong></span></p>', 'content' => '
        <p>Xương là bộ phận quan trọng của cơ thể, giữ vai trò hỗ trợ vận động và bảo vệ các cơ quan nội tạng. Để có
            xương chắc khỏe, việc bổ sung đủ canxi và vitamin D là điều cần thiết, đặc biệt là đối với người cao tuổi,
            những người có nguy cơ cao bị loãng xương và các bệnh lý về xương khớp do thiếu hụt canxi. Bữa sáng là cơ
            hội tốt để bổ sung các dưỡng chất này, giúp cơ thể khỏe mạnh và phòng ngừa nguy cơ mắc bệnh về xương.

            Canxi là thành phần chủ yếu trong cấu trúc xương và răng, giúp xương luôn chắc khỏe. Khi cơ thể không được
            cung cấp đủ canxi, xương sẽ trở nên giòn, yếu, dễ gãy. Đặc biệt ở người cao tuổi, thiếu hụt canxi là một
            trong những nguyên nhân hàng đầu gây loãng xương. Trong khi đó, vitamin D lại đóng vai trò giúp cơ thể hấp
            thụ canxi hiệu quả hơn. Thiếu vitamin D sẽ khiến cơ thể khó hấp thụ canxi, dù lượng canxi cung cấp có đủ đi
            chăng nữa.

            Lựa chọn thực phẩm cho bữa sáng giàu canxi và vitamin D là phương pháp hiệu quả để nâng cao sức khỏe xương.
            Sữa chua là thực phẩm phổ biến, giàu canxi và vitamin D. Một bát sữa chua nhỏ vào bữa sáng không chỉ giúp
            cung cấp năng lượng mà còn bổ sung canxi hiệu quả cho xương.

            Tuy nhiên, để tối ưu cho sức khỏe, bạn nên chọn loại sữa chua tươi thay vì các loại có hương vị vì chúng
            thường chứa đường và các chất phụ gia không tốt. Sữa chua tươi khi kết hợp cùng quả mọng như việt quất, dâu
            tây sẽ cung cấp thêm chất chống oxy hóa, giúp bảo vệ tế bào và giảm nguy cơ lão hóa xương khớp. Thêm một nắm
            nhỏ trái cây khô và hạt vào bữa sáng cũng là một cách bổ sung canxi tuyệt vời. Những loại thực phẩm như quả
            sung khô, hạt chia, hạnh nhân chứa nhiều canxi, mang đến lợi ích không chỉ cho xương mà còn cho sức khỏe
            tổng thể. Tuy nhiên, cần lưu ý kiểm soát khẩu phần ăn, vì trái cây khô và hạt có hàm lượng calo cao. Chỉ cần
            ăn một lượng nhỏ là đủ để tránh tích lũy calo dư thừa. Nước ép, đặc biệt là nước cam, là lựa chọn tốt cho
            bữa sáng. Cam giàu vitamin C và chứa một lượng canxi tự nhiên. Ngoài ra, nước cam cũng giúp cơ thể hấp thụ
            canxi dễ dàng hơn khi kết hợp cùng các thực phẩm khác giàu canxi. Một ly nước cam tươi mát vào bữa sáng sẽ
            giúp cơ thể tỉnh táo và bổ sung dưỡng chất thiết yếu.

            Một bữa sáng với các thực phẩm giàu canxi và vitamin D sẽ mang lại nhiều lợi ích cho cơ thể. Đầu tiên, nó
            giúp tăng cường sức khỏe xương, giảm nguy cơ loãng xương và gãy xương do xương yếu. Canxi và vitamin D cũng
            hỗ trợ chức năng thần kinh, giúp hệ cơ hoạt động tốt hơn và giảm nguy cơ đau nhức cơ khớp. Không chỉ vậy,
            vitamin D còn giúp tăng cường hệ miễn dịch, bảo vệ cơ thể khỏi nguy cơ mắc các bệnh truyền nhiễm.</p>',],
            ['staff_id' => 1, 'highlight' => true, 'title' => 'Bộ Y tế hạ thấp nguy cơ dịch bệnh bạch hầu', 'author' => 'Dược sĩ - Ngô Kim Thúy', 'img' => 'bachhau.jpg', 'abstract' => '<p><span class="text-big"><strong>Bác sĩ Hoàng Minh Đức, Cục trưởng Cục Y tế dự phòng, Bộ Y tế cho biết, bệnh bạch hầu đang được kiểm soát
                và ít có khả năng bùng phát thành dịch ở Việt Nam.</strong></span></p>', 'content' => '<p>Trong thời gian gần đây, thông tin về dịch bệnh bạch hầu tại một số tỉnh như Nghệ An và Bắc Giang đã thu hút
            sự chú ý của dư luận. Tuy nhiên, Bộ Y tế Việt Nam đã chính thức phủ nhận những lo ngại về một đợt dịch bạch
            hầu đang lan rộng trong cộng đồng.Đầu tháng 7, một bệnh nhân ở tỉnh Nghệ An đã tử vong do bệnh bạch hầu, và
            sau đó, hai ca bệnh dương tính khác đã được phát hiện tại tỉnh Bắc Giang. Sự việc này đã khiến nhiều người
            dân lo lắng về nguy cơ lây lan của bệnh. Tuy nhiên, bác sĩ Đức - Cục trưởng Cục Y tế dự phòng, Bộ Y tế cho
            biết, việc bệnh bạch hầu xuất hiện rải rác ở một số khu vực không đồng nghĩa với việc dịch bệnh đang bùng
            phát.Theo ông, mặc dù đã có ca bệnh tử vong, nhưng số ca mắc bạch hầu trong cộng đồng vẫn còn thấp và có thể
            được kiểm soát hiệu quả. Hàng trăm người đã tiếp xúc với các bệnh nhân xác nhận và hiện đang được cách ly để
            theo dõi sức khỏe, điều này cho thấy sự chủ động của ngành y tế trong việc ngăn chặn bệnh lây lan.

            Bạch hầu là một bệnh nhiễm trùng do vi khuẩn gây ra, có thể dẫn đến các biến chứng nghiêm trọng nếu không
            được điều trị kịp thời. Tuy nhiên, nhờ vào chương trình tiêm chủng mở rộng quốc gia, Việt Nam đã giảm đáng
            kể số ca mắc bệnh này. Vắc xin bạch hầu đã được đưa vào chương trình tiêm chủng từ năm 1985 và đã giúp giảm
            số ca mắc bệnh hàng trăm lần, từ khoảng 3.500 ca vào năm 1983 xuống còn con số rất thấp trong những năm gần
            đây.

            Các chuyên gia cho rằng, việc tiêm chủng đầy đủ cho trẻ em là một trong những biện pháp quan trọng nhất để
            phòng ngừa bạch hầu và các bệnh truyền nhiễm khác. Tuy nhiên, tại một số khu vực miền núi và xa xôi, tỷ lệ
            tiêm chủng vẫn chưa đạt 100%, điều này làm tăng nguy cơ bùng phát dịch bệnh.Từ đầu năm 2024 đến nay, cả nước
            đã ghi nhận 06 ca mắc bạch hầu, bao gồm 03 ca tại tỉnh Hà Giang và 03 ca gần đây tại Nghệ An và Bắc Giang.
            So với năm ngoái, đã có tới 57 người mắc bệnh và 07 trường hợp tử vong, con số này cho thấy tình hình đã
            được cải thiện đáng kể.

            Các chuyên gia sức khỏe khuyến cáo rằng, mặc dù hiện tại bệnh bạch hầu không phải là mối đe dọa nguy hiểm,
            nhưng người dân vẫn cần phải nâng cao nhận thức về bệnh. Việc thực hiện các biện pháp phòng ngừa như giữ gìn
            vệ sinh cá nhân, thường xuyên rửa tay, và tuân thủ lịch tiêm chủng là rất quan trọng.

            Ngoài ra, chính quyền địa phương cũng cần tăng cường công tác tuyên truyền để người dân hiểu rõ về triệu
            chứng, cách lây lan, và phương pháp phòng ngừa bạch hầu. Những buổi hội thảo, diễn đàn cộng đồng về sức khỏe
            nên được tổ chức thường xuyên để nâng cao nhận thức và tạo ra một môi trường sống an toàn hơn cho mọi người.

            Trong bối cảnh dịch bệnh bạch hầu xuất hiện rải rác, việc Bộ Y tế khẳng định rằng nguy cơ dịch bệnh bạch hầu
            lan rộng ra cộng đồng là rất thấp là một tín hiệu tích cực. Điều này cho thấy sự chủ động và nỗ lực không
            ngừng của ngành y tế trong việc kiểm soát dịch bệnh, bảo vệ sức khỏe cộng đồng.Tuy nhiên, để duy trì tình
            trạng an toàn này, mỗi cá nhân cần nâng cao ý thức bảo vệ sức khỏe bản thân và gia đình. Việc thực hiện đầy
            đủ các biện pháp phòng ngừa và tiêm chủng đúng lịch là điều cần thiết để đảm bảo rằng bạch hầu không có cơ
            hội bùng phát trở lại.

            Sự hợp tác giữa chính quyền, ngành y tế và cộng đồng là yếu tố then chốt trong công tác phòng chống dịch
            bệnh, đảm bảo sức khỏe cho người dân, góp phần xây dựng một xã hội khỏe mạnh và an toàn. </p>',]
        ];

        foreach ($items as $item) {
            News::updateOrCreate($item);
        }
    }
}
