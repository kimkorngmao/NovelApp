<?php

namespace Database\Seeders;

use App\Models\Novel;
use App\Models\Chapter;
use App\Models\NovelCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class NovelSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();
        $fantasyCategory = NovelCategory::where('slug', 'fantasy')->first();
        $romanceCategory = NovelCategory::where('slug', 'romance')->first();

        // Novel 1 - Fantasy
        $novel1 = Novel::create([
            'category_id' => $fantasyCategory->id,
            'user_id' => $user->id,
            'cover_image' => 'covers/oH9krJ4f9LfV7ptQN6RuCcWGoN6adek6EQNp4z9k.png',            
            'title' => 'ผจญภัยในดินแดนมังกร',
            'slug' => 'dragon-realm-adventure',
            'description' => 'เรื่องราวของนักผจญภัยหนุ่มที่ได้รับพลังพิเศษจากมังกรโบราณ และต้องปกป้องดินแดนจากภัยคุกคาม',
            'status' => 'ongoing',
            'is_published' => true,
            'views' => 0
        ]);

        Chapter::create([
            'novel_id' => $novel1->id,
            'title' => 'การเริ่มต้นใหม่',            
            'content' => 'ท้องฟ้าสีครามในยามเช้าตรู่ถูกแต้มด้วยเมฆขาวบางเบา เสียงนกร้องดังแว่วมาแต่ไกล ณ หมู่บ้านเล็กๆ แห่งหนึ่ง เด็กหนุ่มนามว่าไทเกอร์กำลังออกเดินทางครั้งใหม่...',
            'chapter_number' => 1,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel1->id,
            'title' => 'พลังที่ตื่นขึ้น',            
            'content' => 'แสงสีทองวาบขึ้นรอบตัวไทเกอร์ เขารู้สึกถึงพลังบางอย่างที่ไหลเวียนอยู่ในร่างกาย เสียงกระซิบของมังกรโบราณดังก้องในหัว...',
            'chapter_number' => 2,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel1->id,
            'title' => 'ศัตรูที่ซ่อนเร้น',            
            'content' => 'เงาดำทะมึนปรากฏขึ้นที่ขอบฟ้า กลิ่นอายชั่วร้ายแผ่ซ่านไปทั่ว ไทเกอร์รู้ดีว่านี่เป็นเพียงจุดเริ่มต้นของการต่อสู้ครั้งยิ่งใหญ่...',
            'chapter_number' => 3,
            'is_published' => true,
        ]);

        // Novel 2 - Romance
        $novel2 = Novel::create([
            'category_id' => $romanceCategory->id,
            'user_id' => $user->id,
            'cover_image' => 'covers/4DHLQfhHbi9VzhwFBSE4POdSjwmxW6yfGLDASZyR.png',
            'title' => 'รักซ่อนใจ',
            'slug' => 'hidden-love',
            'description' => 'เรื่องราวความรักของสาวออฟฟิศที่ต้องมาทำงานร่วมกับเจ้านายหนุ่มที่เธอแอบชอบมานาน',
            'status' => 'ongoing',
            'is_published' => true,
            'views' => 0
        ]);

        Chapter::create([
            'novel_id' => $novel2->id,
            'title' => 'วันแรกที่พบเธอ',            
            'content' => 'นภาก้าวเข้าสู่อาคารสำนักงานด้วยความตื่นเต้น วันนี้เป็นวันแรกของการทำงานในตำแหน่งใหม่ และเธอก็จะได้ทำงานใกล้ชิดกับคุณภูริ เจ้านายหนุ่มที่เธอแอบหลงรักมานาน...',
            'chapter_number' => 1,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel2->id,
            'title' => 'ความลับในใจ',            
            'content' => 'ทุกครั้งที่ได้ทำงานร่วมกัน หัวใจของนภาก็เต้นแรงขึ้น เธอพยายามซ่อนความรู้สึกไว้ แต่สายตาที่มองมาจากเขาทำให้เธอสับสน...',
            'chapter_number' => 2,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel2->id,
            'title' => 'เข้าใจผิดหรือเปล่า',            
            'content' => 'เสียงซุบซิบในออฟฟิศเริ่มดังขึ้น เมื่อมีคนเห็นภูริกับเลขาสาวสวยคนใหม่ไปทานข้าวด้วยกัน นภารู้สึกเจ็บปวดในใจ...',
            'chapter_number' => 3,
            'is_published' => true,
        ]);

        // Novel 3 - Fantasy
        $novel3 = Novel::create([
            'category_id' => $fantasyCategory->id,
            'user_id' => $user->id,
            'cover_image' => 'covers/qsDA2Z2VCTXKfndIofPCr5blxEPDbFiNXAJWCMxN.png',
            'title' => 'เวทมนตร์แห่งรัตติกาล',
            'slug' => 'night-magic',
            'description' => 'ในโลกที่เวทมนตร์ถูกปลดปล่อยเฉพาะในยามค่ำคืน สาวน้อยผู้มีพลังพิเศษต้องค้นหาความจริงเกี่ยวกับชะตากรรมของตัวเอง',
            'status' => 'ongoing',
            'is_published' => true,
            'views' => 0
        ]);

        Chapter::create([
            'novel_id' => $novel3->id,
            'title' => 'คืนแห่งการตื่นรู้',            
            'content' => 'พระจันทร์เต็มดวงส่องแสงสลัว ลินดาตื่นขึ้นมาในความมืด และพบว่าเธอสามารถมองเห็นเส้นสายของเวทมนตร์ที่พัวพันอยู่รอบตัว...',
            'chapter_number' => 1,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel3->id,
            'title' => 'ครูผู้ลึกลับ',            
            'content' => 'หญิงชราในชุดดำปรากฏตัวที่หน้าบ้านของลินดา เธอบอกว่ารู้ความลับเกี่ยวกับพลังของลินดา และเสนอตัวจะสอนวิธีควบคุมมัน...',
            'chapter_number' => 2,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel3->id,
            'title' => 'พันธะแห่งรัตติกาล',            
            'content' => 'การฝึกฝนเริ่มต้นขึ้น ลินดาเรียนรู้ว่าพลังของเธอเชื่อมโยงกับตำนานโบราณ และเธอมีบทบาทสำคัญในการปกป้องโลกยามค่ำคืน...',
            'chapter_number' => 3,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel3->id,
            'title' => 'ความจริงที่ถูกซ่อน',            
            'content' => 'เมื่อลินดาค้นพบบันทึกเก่าในห้องใต้หลังคา เธอเริ่มเข้าใจว่าครอบครัวของเธอมีความเกี่ยวข้องกับโลกแห่งเวทมนตร์มายาวนาน...',
            'chapter_number' => 4,
            'is_published' => true,
        ]);

        // Novel 4 - Romance
        $novel4 = Novel::create([
            'category_id' => $romanceCategory->id,
            'user_id' => $user->id,
            'cover_image' => 'covers/6tDHkh9EKWeTNlxGc4M4ClWqHTkoLhzFQEQJlmjY.png',
            'title' => 'คาเฟ่หัวใจสีชมพู',
            'slug' => 'pink-heart-cafe',
            'description' => 'เรื่องราวของมินนี่ สาวน้อยที่ฝันอยากเปิดร้านกาแฟของตัวเอง และวันหนึ่งเธอได้พบกับหนุ่มลึกลับที่มาเป็นลูกค้าประจำ',
            'status' => 'ongoing',
            'is_published' => true,
            'views' => 0
        ]);

        Chapter::create([
            'novel_id' => $novel4->id,
            'title' => 'กลิ่นกาแฟและความทรงจำ',            
            'content' => 'เสียงกระดิ่งที่ประตูดังกังวาน มินนี่หันไปมองด้วยรอยยิ้ม ลูกค้าคนแรกของวันเดินเข้ามาในร้านที่เพิ่งเปิดได้ไม่กี่วัน เขาเป็นชายหนุ่มในชุดสูทสีเทา ดวงตาคมกริบที่มองมาทำให้หัวใจเธอเต้นไม่เป็นส่ำ...',
            'chapter_number' => 1,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel4->id,
            'title' => 'ความลับของกาแฟดำ',            
            'content' => 'ทุกเช้าเขาจะสั่งกาแฟดำ นั่งมุมเดิม และดูเหมือนจะจมอยู่กับความคิดบางอย่าง มินนี่อดสงสัยไม่ได้ว่าอะไรทำให้เขาดูเศร้าขนาดนั้น...',
            'chapter_number' => 2,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel4->id,
            'title' => 'รสชาติแห่งความทรงจำ',            
            'content' => 'วันนี้เขาไม่ได้มาตามปกติ มินนี่รู้สึกหวั่นใจ จนกระทั่งเธอได้รับจดหมายปริศนาที่บอกเล่าเรื่องราวของเขา และความเชื่อมโยงระหว่างพวกเขาที่มีมาตั้งแต่อดีต...',
            'chapter_number' => 3,
            'is_published' => true,
        ]);

        // Novel 5 - Fantasy
        $novel5 = Novel::create([
            'category_id' => $fantasyCategory->id,
            'user_id' => $user->id,
            'cover_image' => 'covers/k9CKguXVgDWBQ4w53Kgg8LG69oylABSGNUrSkCgr.png',
            'title' => 'ตำนานนักรบพันธุ์มังกร',
            'slug' => 'dragon-warrior-legend',
            'description' => 'ในโลกที่มนุษย์และมังกรอยู่ร่วมกัน เด็กหนุ่มผู้มีเลือดผสมของทั้งสองเผ่าพันธุ์ต้องค้นหาตัวตนที่แท้จริงของตนเอง',
            'status' => 'ongoing',
            'is_published' => true,
            'views' => 0
        ]);

        Chapter::create([
            'novel_id' => $novel5->id,
            'title' => 'สายเลือดที่ตื่น',            
            'content' => 'ครั้งแรกที่คาย่าเห็นเกล็ดสีทองผุดขึ้นบนผิวของเขา เขารู้ว่าชีวิตจะไม่มีวันเหมือนเดิมอีกต่อไป เสียงกระซิบของบรรพบุรุษเริ่มดังก้องในความคิด...',
            'chapter_number' => 1,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel5->id,
            'title' => 'บททดสอบแห่งเปลวไฟ',            
            'content' => 'ที่หุบเขามังกรศักดิ์สิทธิ์ คาย่าต้องเผชิญกับการทดสอบครั้งแรก การควบคุมไฟมังกรที่อยู่ภายในไม่ใช่เรื่องง่าย โดยเฉพาะเมื่อมีคนพยายามล้มเขาอยู่...',
            'chapter_number' => 2,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel5->id,
            'title' => 'พันธมิตรที่ไม่คาดฝัน',            
            'content' => 'ในป่าลึก คาย่าพบกับมังกรน้อยที่บาดเจ็บ การช่วยเหลือครั้งนี้นำไปสู่การค้นพบความจริงเกี่ยวกับชะตากรรมของทั้งสองเผ่าพันธุ์...',
            'chapter_number' => 3,
            'is_published' => true,
        ]);

        // Novel 6 - Romance
        $novel6 = Novel::create([
            'category_id' => $romanceCategory->id,
            'user_id' => $user->id,
            'cover_image' => 'covers/k9CKguXVgDWBQ4w53Kgg8LG69oylABSGNUrSkCgr.png',
            'title' => 'ฤดูฝันของหัวใจ',
            'slug' => 'dream-season',
            'description' => 'เรื่องราวความรักของนักดนตรีสาวที่ฝันจะเป็นนักแต่งเพลง กับโปรดิวเซอร์หนุ่มที่กำลังตามหาเสียงเพลงที่หายไป',
            'status' => 'ongoing',
            'is_published' => true,
            'views' => 0
        ]);

        Chapter::create([
            'novel_id' => $novel6->id,
            'title' => 'เสียงเพลงแห่งการพบกัน',            
            'content' => 'เสียงเปียโนแว่วมาจากห้องซ้อมเล็กๆ ในตึกเก่า นรินทร์หยุดฝีเท้าและฟังอย่างตั้งใจ ท่วงทำนองนี้... มันคือเพลงที่เขาตามหามาตลอดสองปี...',
            'chapter_number' => 1,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel6->id,
            'title' => 'โน้ตเพลงและความทรงจำ',            
            'content' => 'พิมมาลาไม่เคยคิดว่าเพลงที่เธอแต่งจะเป็นเพลงที่ใครคนหนึ่งตามหา เมื่อนรินทร์บอกความจริง เธอเริ่มนึกถึงวันที่เขียนมัน และความรู้สึกที่อัดแน่นในหัวใจ...',
            'chapter_number' => 2,
            'is_published' => true,
        ]);

        Chapter::create([
            'novel_id' => $novel6->id,
            'title' => 'บทเพลงของเรา',            
            'content' => 'การทำงานร่วมกันเริ่มต้นขึ้น แต่ละโน้ตดนตรีที่พวกเขาร่วมกันสร้าง ไม่เพียงแต่เป็นเพลงใหม่ แต่ยังเป็นเรื่องราวความรักที่กำลังก่อตัว...',
            'chapter_number' => 3,
            'is_published' => true,
        ]);
    }
}
