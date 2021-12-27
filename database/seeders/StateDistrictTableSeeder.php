<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateDistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $IndianStates = array(
            'AN' =>
            array(
                'name' => 'Andaman and Nicobar Island (UT)',
                'districts' =>
                array(
                    1 => 'Nicobar',
                    2 => 'North and Middle Andaman',
                    3 => 'South Andaman',
                ),
            ),
            'AP' =>
            array(
                'name' => 'Andhra Pradesh',
                'districts' =>
                array(
                    1 => 'Anantapur',
                    2 => 'Chittoor',
                    3 => 'East Godavari',
                    4 => 'Guntur',
                    5 => 'Krishna',
                    6 => 'Kurnool',
                    7 => 'Prakasam',
                    8 => 'Srikakulam',
                    9 => 'Sri Potti Sriramulu Nellore',
                    10 => 'Visakhapatnam',
                    11 => 'Vizianagaram',
                    12 => 'West Godavari',
                    13 => 'YSR District, Kadapa (Cuddapah)',
                ),
            ),
            'AR' =>
            array(
                'name' => 'Arunachal Pradesh',
                'districts' =>
                array(
                    1 => 'Anjaw',
                    2 => 'Changlang',
                    3 => 'Dibang Valley',
                    4 => 'East Kameng',
                    5 => 'East Siang',
                    6 => 'Kra Daadi',
                    7 => 'Kurung Kumey',
                    8 => 'Lohit',
                    9 => 'Longding',
                    10 => 'Lower Dibang Valley',
                    11 => 'Lower Siang',
                    12 => 'Lower Subansiri',
                    13 => 'Namsai',
                    14 => 'Papum Pare',
                    15 => 'Siang',
                    16 => 'Tawang',
                    17 => 'Tirap',
                    18 => 'Upper Siang',
                    19 => 'Upper Subansiri',
                    20 => 'West Kameng',
                    21 => 'West Siang',
                ),
            ),
            'AS' =>
            array(
                'name' => 'Assam',
                'districts' =>
                array(
                    1 => 'Baksa',
                    2 => 'Barpeta',
                    3 => 'Biswanath',
                    4 => 'Bongaigaon',
                    5 => 'Cachar',
                    6 => 'Charaideo',
                    7 => 'Chirang',
                    8 => 'Darrang',
                    9 => 'Dhemaji',
                    10 => 'Dhubri',
                    11 => 'Dibrugarh',
                    12 => 'Dima Hasao (North Cachar Hills)',
                    13 => 'Goalpara',
                    14 => 'Golaghat',
                    15 => 'Hailakandi',
                    16 => 'Hojai',
                    17 => 'Jorhat',
                    18 => 'Kamrup',
                    19 => 'Kamrup Metropolitan',
                    20 => 'Karbi Anglong',
                    21 => 'Karimganj',
                    22 => 'Kokrajhar',
                    23 => 'Lakhimpur',
                    24 => 'Majuli',
                    25 => 'Morigaon',
                    26 => 'Nagaon',
                    27 => 'Nalbari',
                    28 => 'Sivasagar',
                    29 => 'Sonitpur',
                    30 => 'South Salamara-Mankachar',
                    31 => 'Tinsukia',
                    32 => 'Udalguri',
                    33 => 'West Karbi Anglong',
                ),
            ),
            'BR' =>
            array(
                'name' => 'Bihar',
                'districts' =>
                array(
                    1 => 'Araria',
                    2 => 'Arwal',
                    3 => 'Aurangabad',
                    4 => 'Banka',
                    5 => 'Begusarai',
                    6 => 'Bhagalpur',
                    7 => 'Bhojpur',
                    8 => 'Buxar',
                    9 => 'Darbhanga',
                    10 => 'East Champaran (Motihari)',
                    11 => 'Gaya',
                    12 => 'Gopalganj',
                    13 => 'Jamui',
                    14 => 'Jehanabad',
                    15 => 'Kaimur (Bhabua)',
                    16 => 'Katihar',
                    17 => 'Khagaria',
                    18 => 'Kishanganj',
                    19 => 'Lakhisarai',
                    20 => 'Madhepura',
                    21 => 'Madhubani',
                    22 => 'Munger (Monghyr)',
                    23 => 'Muzaffarpur',
                    24 => 'Nalanda',
                    25 => 'Nawada',
                    26 => 'Patna',
                    27 => 'Purnia (Purnea)',
                    28 => 'Rohtas',
                    29 => 'Saharsa',
                    30 => 'Samastipur',
                    31 => 'Saran',
                    32 => 'Sheikhpura',
                    33 => 'Sheohar',
                    34 => 'Sitamarhi',
                    35 => 'Siwan',
                    36 => 'Supaul',
                    37 => 'Vaishali',
                    38 => 'West Champaran',
                ),
            ),
            'CH' =>
            array(
                'name' => 'Chandigarh (UT)',
                'districts' =>
                array(
                    1 => 'Chandigarh',
                ),
            ),
            'CG' =>
            array(
                'name' => 'Chhattisgarh',
                'districts' =>
                array(
                    1 => 'Balod',
                    2 => 'Baloda Bazar',
                    3 => 'Balrampur',
                    4 => 'Bastar',
                    5 => 'Bemetara',
                    6 => 'Bijapur',
                    7 => 'Bilaspur',
                    8 => 'Dantewada (South Bastar)',
                    9 => 'Dhamtari',
                    10 => 'Durg',
                    11 => 'Gariyaband',
                    12 => 'Janjgir-Champa',
                    13 => 'Jashpur',
                    14 => 'Kabirdham (Kawardha)',
                    15 => 'Kanker (North Bastar)',
                    16 => 'Kondagaon',
                    17 => 'Korba',
                    18 => 'Korea (Koriya)',
                    19 => 'Mahasamund',
                    20 => 'Mungeli',
                    21 => 'Narayanpur',
                    22 => 'Raigarh',
                    23 => 'Raipur',
                    24 => 'Rajnandgaon',
                    25 => 'Sukma',
                    26 => 'Surajpur  ',
                    27 => 'Surguja',
                ),
            ),
            'DN' =>
            array(
                'name' => 'Dadra and Nagar Haveli (UT)',
                'districts' =>
                array(
                    1 => 'Dadra & Nagar Haveli',
                ),
            ),
            'DD' =>
            array(
                'name' => 'Daman and Diu (UT)',
                'districts' =>
                array(
                    1 => 'Daman',
                    2 => 'Diu',
                ),
            ),
            'DL' =>
            array(
                'name' => 'Delhi (NCT)',
                'districts' =>
                array(
                    1 => 'Central Delhi',
                    2 => 'East Delhi',
                    3 => 'New Delhi',
                    4 => 'North Delhi',
                    5 => 'North East  Delhi',
                    6 => 'North West  Delhi',
                    7 => 'Shahdara',
                    8 => 'South Delhi',
                    9 => 'South East Delhi',
                    10 => 'South West  Delhi',
                    11 => 'West Delhi',
                ),
            ),
            'GA' =>
            array(
                'name' => 'Goa',
                'districts' =>
                array(
                    1 => 'North Goa',
                    2 => 'South Goa',
                ),
            ),
            'GJ' =>
            array(
                'name' => 'Gujarat',
                'districts' =>
                array(
                    1 => 'Ahmedabad',
                    2 => 'Amreli',
                    3 => 'Anand',
                    4 => 'Aravalli',
                    5 => 'Banaskantha (Palanpur)',
                    6 => 'Bharuch',
                    7 => 'Bhavnagar',
                    8 => 'Botad',
                    9 => 'Chhota Udepur',
                    10 => 'Dahod',
                    11 => 'Dangs (Ahwa)',
                    12 => 'Devbhoomi Dwarka',
                    13 => 'Gandhinagar',
                    14 => 'Gir Somnath',
                    15 => 'Jamnagar',
                    16 => 'Junagadh',
                    17 => 'Kachchh',
                    18 => 'Kheda (Nadiad)',
                    19 => 'Mahisagar',
                    20 => 'Mehsana',
                    21 => 'Morbi',
                    22 => 'Narmada (Rajpipla)',
                    23 => 'Navsari',
                    24 => 'Panchmahal (Godhra)',
                    25 => 'Patan',
                    26 => 'Porbandar',
                    27 => 'Rajkot',
                    28 => 'Sabarkantha (Himmatnagar)',
                    29 => 'Surat',
                    30 => 'Surendranagar',
                    31 => 'Tapi (Vyara)',
                    32 => 'Vadodara',
                    33 => 'Valsad',
                ),
            ),
            'HR' =>
            array(
                'name' => 'Haryana',
                'districts' =>
                array(
                    1 => 'Ambala',
                    2 => 'Bhiwani',
                    3 => 'Charkhi Dadri',
                    4 => 'Faridabad',
                    5 => 'Fatehabad',
                    6 => 'Gurgaon',
                    7 => 'Hisar',
                    8 => 'Jhajjar',
                    9 => 'Jind',
                    10 => 'Kaithal',
                    11 => 'Karnal',
                    12 => 'Kurukshetra',
                    13 => 'Mahendragarh',
                    14 => 'Mewat',
                    15 => 'Palwal',
                    16 => 'Panchkula',
                    17 => 'Panipat',
                    18 => 'Rewari',
                    19 => 'Rohtak',
                    20 => 'Sirsa',
                    21 => 'Sonipat',
                    22 => 'Yamunanagar',
                ),
            ),
            'HP' =>
            array(
                'name' => 'Himachal Pradesh',
                'districts' =>
                array(
                    1 => 'Bilaspur',
                    2 => 'Chamba',
                    3 => 'Hamirpur',
                    4 => 'Kangra',
                    5 => 'Kinnaur',
                    6 => 'Kullu',
                    7 => 'Lahaul & Spiti',
                    8 => 'Mandi',
                    9 => 'Shimla',
                    10 => 'Sirmaur (Sirmour)',
                    11 => 'Solan',
                    12 => 'Una',
                ),
            ),
            'JK' =>
            array(
                'name' => 'Jammu and Kashmir',
                'districts' =>
                array(
                    1 => 'Anantnag',
                    2 => 'Bandipore',
                    3 => 'Baramulla',
                    4 => 'Budgam',
                    5 => 'Doda',
                    6 => 'Ganderbal',
                    7 => 'Jammu',
                    8 => 'Kargil',
                    9 => 'Kathua',
                    10 => 'Kishtwar',
                    11 => 'Kulgam',
                    12 => 'Kupwara',
                    13 => 'Leh',
                    14 => 'Poonch',
                    15 => 'Pulwama',
                    16 => 'Rajouri',
                    17 => 'Ramban',
                    18 => 'Reasi',
                    19 => 'Samba',
                    20 => 'Shopian',
                    21 => 'Srinagar',
                    22 => 'Udhampur',
                ),
            ),
            'JH' =>
            array(
                'name' => 'Jharkhand',
                'districts' =>
                array(
                    1 => 'Bokaro',
                    2 => 'Chatra',
                    3 => 'Deoghar',
                    4 => 'Dhanbad',
                    5 => 'Dumka',
                    6 => 'East Singhbhum',
                    7 => 'Garhwa',
                    8 => 'Giridih',
                    9 => 'Godda',
                    10 => 'Gumla',
                    11 => 'Hazaribag',
                    12 => 'Jamtara',
                    13 => 'Khunti',
                    14 => 'Koderma',
                    15 => 'Latehar',
                    16 => 'Lohardaga',
                    17 => 'Pakur',
                    18 => 'Palamu',
                    19 => 'Ramgarh',
                    20 => 'Ranchi',
                    21 => 'Sahibganj',
                    22 => 'Seraikela-Kharsawan',
                    23 => 'Simdega',
                    24 => 'West Singhbhum',
                ),
            ),
            'KA' =>
            array(
                'name' => 'Karnataka',
                'districts' =>
                array(
                    1 => 'Bagalkot',
                    2 => 'Ballari (Bellary)',
                    3 => 'Belagavi (Belgaum)',
                    4 => 'Bengaluru (Bangalore) Rural',
                    5 => 'Bengaluru (Bangalore) Urban',
                    6 => 'Bidar',
                    7 => 'Chamarajanagar',
                    8 => 'Chikballapur',
                    9 => 'Chikkamagaluru (Chikmagalur)',
                    10 => 'Chitradurga',
                    11 => 'Dakshina Kannada',
                    12 => 'Davangere',
                    13 => 'Dharwad',
                    14 => 'Gadag',
                    15 => 'Hassan',
                    16 => 'Haveri',
                    17 => 'Kalaburagi (Gulbarga)',
                    18 => 'Kodagu',
                    19 => 'Kolar',
                    20 => 'Koppal',
                    21 => 'Mandya',
                    22 => 'Mysuru (Mysore)',
                    23 => 'Raichur',
                    24 => 'Ramanagara',
                    25 => 'Shivamogga (Shimoga)',
                    26 => 'Tumakuru (Tumkur)',
                    27 => 'Udupi',
                    28 => 'Uttara Kannada (Karwar)',
                    29 => 'Vijayapura (Bijapur)',
                    30 => 'Yadgir',
                ),
            ),
            'KL' =>
            array(
                'name' => 'Kerala',
                'districts' =>
                array(
                    1 => 'Alappuzha',
                    2 => 'Ernakulam',
                    3 => 'Idukki',
                    4 => 'Kannur',
                    5 => 'Kasaragod',
                    6 => 'Kollam',
                    7 => 'Kottayam',
                    8 => 'Kozhikode',
                    9 => 'Malappuram',
                    10 => 'Palakkad',
                    11 => 'Pathanamthitta',
                    12 => 'Thiruvananthapuram',
                    13 => 'Thrissur',
                    14 => 'Wayanad',
                ),
            ),
            'LD' =>
            array(
                'name' => 'Lakshadweep (UT)',
                'districts' =>
                array(
                    1 => 'Lakshadweep',
                ),
            ),
            'MP' =>
            array(
                'name' => 'Madhya Pradesh',
                'districts' =>
                array(
                    1 => 'Agar Malwa',
                    2 => 'Alirajpur',
                    3 => 'Anuppur',
                    4 => 'Ashoknagar',
                    5 => 'Balaghat',
                    6 => 'Barwani',
                    7 => 'Betul',
                    8 => 'Bhind',
                    9 => 'Bhopal',
                    10 => 'Burhanpur',
                    11 => 'Chhatarpur',
                    12 => 'Chhindwara',
                    13 => 'Damoh',
                    14 => 'Datia',
                    15 => 'Dewas',
                    16 => 'Dhar',
                    17 => 'Dindori',
                    18 => 'Guna',
                    19 => 'Gwalior',
                    20 => 'Harda',
                    21 => 'Hoshangabad',
                    22 => 'Indore',
                    23 => 'Jabalpur',
                    24 => 'Jhabua',
                    25 => 'Katni',
                    26 => 'Khandwa',
                    27 => 'Khargone',
                    28 => 'Mandla',
                    29 => 'Mandsaur',
                    30 => 'Morena',
                    31 => 'Narsinghpur',
                    32 => 'Neemuch',
                    33 => 'Panna',
                    34 => 'Raisen',
                    35 => 'Rajgarh',
                    36 => 'Ratlam',
                    37 => 'Rewa',
                    38 => 'Sagar',
                    39 => 'Satna',
                    40 => 'Sehore',
                    41 => 'Seoni',
                    42 => 'Shahdol',
                    43 => 'Shajapur',
                    44 => 'Sheopur',
                    45 => 'Shivpuri',
                    46 => 'Sidhi',
                    47 => 'Singrauli',
                    48 => 'Tikamgarh',
                    49 => 'Ujjain',
                    50 => 'Umaria',
                    51 => 'Vidisha',
                ),
            ),
            'MH' =>
            array(
                'name' => 'Maharashtra',
                'districts' =>
                array(
                    1 => 'Ahmednagar',
                    2 => 'Akola',
                    3 => 'Amravati',
                    4 => 'Aurangabad',
                    5 => 'Beed',
                    6 => 'Bhandara',
                    7 => 'Buldhana',
                    8 => 'Chandrapur',
                    9 => 'Dhule',
                    10 => 'Gadchiroli',
                    11 => 'Gondia',
                    12 => 'Hingoli',
                    13 => 'Jalgaon',
                    14 => 'Jalna',
                    15 => 'Kolhapur',
                    16 => 'Latur',
                    17 => 'Mumbai City',
                    18 => 'Mumbai Suburban',
                    19 => 'Nagpur',
                    20 => 'Nanded',
                    21 => 'Nandurbar',
                    22 => 'Nashik',
                    23 => 'Osmanabad',
                    24 => 'Palghar',
                    25 => 'Parbhani',
                    26 => 'Pune',
                    27 => 'Raigad',
                    28 => 'Ratnagiri',
                    29 => 'Sangli',
                    30 => 'Satara',
                    31 => 'Sindhudurg',
                    32 => 'Solapur',
                    33 => 'Thane',
                    34 => 'Wardha',
                    35 => 'Washim',
                    36 => 'Yavatmal',
                ),
            ),
            'MN' =>
            array(
                'name' => 'Manipur',
                'districts' =>
                array(
                    1 => 'Bishnupur',
                    2 => 'Chandel',
                    3 => 'Churachandpur',
                    4 => 'Imphal East',
                    5 => 'Imphal West',
                    6 => 'Jiribam',
                    7 => 'Kakching',
                    8 => 'Kamjong',
                    9 => 'Kangpokpi',
                    10 => 'Noney',
                    11 => 'Pherzawl',
                    12 => 'Senapati',
                    13 => 'Tamenglong',
                    14 => 'Tengnoupal',
                    15 => 'Thoubal',
                    16 => 'Ukhrul',
                ),
            ),
            'ML' =>
            array(
                'name' => 'Meghalaya',
                'districts' =>
                array(
                    1 => 'East Garo Hills',
                    2 => 'East Jaintia Hills',
                    3 => 'East Khasi Hills',
                    4 => 'North Garo Hills',
                    5 => 'Ri Bhoi',
                    6 => 'South Garo Hills',
                    7 => 'South West Garo Hills ',
                    8 => 'South West Khasi Hills',
                    9 => 'West Garo Hills',
                    10 => 'West Jaintia Hills',
                    11 => 'West Khasi Hills',
                ),
            ),
            'MZ' =>
            array(
                'name' => 'Mizoram',
                'districts' =>
                array(
                    1 => 'Aizawl',
                    2 => 'Champhai',
                    3 => 'Kolasib',
                    4 => 'Lawngtlai',
                    5 => 'Lunglei',
                    6 => 'Mamit',
                    7 => 'Saiha',
                    8 => 'Serchhip',
                ),
            ),
            'NL' =>
            array(
                'name' => 'Nagaland',
                'districts' =>
                array(
                    1 => 'Dimapur',
                    2 => 'Kiphire',
                    3 => 'Kohima',
                    4 => 'Longleng',
                    5 => 'Mokokchung',
                    6 => 'Mon',
                    7 => 'Peren',
                    8 => 'Phek',
                    9 => 'Tuensang',
                    10 => 'Wokha',
                    11 => 'Zunheboto',
                ),
            ),
            'OR' =>
            array(
                'name' => 'Odisha',
                'districts' =>
                array(
                    1 => 'Angul',
                    2 => 'Balangir',
                    3 => 'Balasore',
                    4 => 'Bargarh',
                    5 => 'Bhadrak',
                    6 => 'Boudh',
                    7 => 'Cuttack',
                    8 => 'Deogarh',
                    9 => 'Dhenkanal',
                    10 => 'Gajapati',
                    11 => 'Ganjam',
                    12 => 'Jagatsinghapur',
                    13 => 'Jajpur',
                    14 => 'Jharsuguda',
                    15 => 'Kalahandi',
                    16 => 'Kandhamal',
                    17 => 'Kendrapara',
                    18 => 'Kendujhar (Keonjhar)',
                    19 => 'Khordha',
                    20 => 'Koraput',
                    21 => 'Malkangiri',
                    22 => 'Mayurbhanj',
                    23 => 'Nabarangpur',
                    24 => 'Nayagarh',
                    25 => 'Nuapada',
                    26 => 'Puri',
                    27 => 'Rayagada',
                    28 => 'Sambalpur',
                    29 => 'Sonepur',
                    30 => 'Sundargarh',
                ),
            ),
            'PY' =>
            array(
                'name' => 'Puducherry (UT)',
                'districts' =>
                array(
                    1 => 'Karaikal',
                    2 => 'Mahe',
                    3 => 'Pondicherry',
                    4 => 'Yanam',
                ),
            ),
            'PB' =>
            array(
                'name' => 'Punjab',
                'districts' =>
                array(
                    1 => 'Amritsar',
                    2 => 'Barnala',
                    3 => 'Bathinda',
                    4 => 'Faridkot',
                    5 => 'Fatehgarh Sahib',
                    6 => 'Fazilka',
                    7 => 'Ferozepur',
                    8 => 'Gurdaspur',
                    9 => 'Hoshiarpur',
                    10 => 'Jalandhar',
                    11 => 'Kapurthala',
                    12 => 'Ludhiana',
                    13 => 'Mansa',
                    14 => 'Moga',
                    15 => 'Muktsar',
                    16 => 'Nawanshahr (Shahid Bhagat Singh Nagar)',
                    17 => 'Pathankot',
                    18 => 'Patiala',
                    19 => 'Rupnagar',
                    20 => 'Sahibzada Ajit Singh Nagar (Mohali)',
                    21 => 'Sangrur',
                    22 => 'Tarn Taran',
                ),
            ),
            'RJ' =>
            array(
                'name' => 'Rajasthan',
                'districts' =>
                array(
                    1 => 'Ajmer',
                    2 => 'Alwar',
                    3 => 'Banswara',
                    4 => 'Baran',
                    5 => 'Barmer',
                    6 => 'Bharatpur',
                    7 => 'Bhilwara',
                    8 => 'Bikaner',
                    9 => 'Bundi',
                    10 => 'Chittorgarh',
                    11 => 'Churu',
                    12 => 'Dausa',
                    13 => 'Dholpur',
                    14 => 'Dungarpur',
                    15 => 'Hanumangarh',
                    16 => 'Jaipur',
                    17 => 'Jaisalmer',
                    18 => 'Jalore',
                    19 => 'Jhalawar',
                    20 => 'Jhunjhunu',
                    21 => 'Jodhpur',
                    22 => 'Karauli',
                    23 => 'Kota',
                    24 => 'Nagaur',
                    25 => 'Pali',
                    26 => 'Pratapgarh',
                    27 => 'Rajsamand',
                    28 => 'Sawai Madhopur',
                    29 => 'Sikar',
                    30 => 'Sirohi',
                    31 => 'Sri Ganganagar',
                    32 => 'Tonk',
                    33 => 'Udaipur',
                ),
            ),
            'SK' =>
            array(
                'name' => 'Sikkim',
                'districts' =>
                array(
                    1 => 'East Sikkim',
                    2 => 'North Sikkim',
                    3 => 'South Sikkim',
                    4 => 'West Sikkim',
                ),
            ),
            'TN' =>
            array(
                'name' => 'Tamil Nadu',
                'districts' =>
                array(
                    1 => 'Ariyalur',
                    2 => 'Chennai',
                    3 => 'Coimbatore',
                    4 => 'Cuddalore',
                    5 => 'Dharmapuri',
                    6 => 'Dindigul',
                    7 => 'Erode',
                    8 => 'Kanchipuram',
                    9 => 'Kanyakumari',
                    10 => 'Karur',
                    11 => 'Krishnagiri',
                    12 => 'Madurai',
                    13 => 'Nagapattinam',
                    14 => 'Namakkal',
                    15 => 'Nilgiris',
                    16 => 'Perambalur',
                    17 => 'Pudukkottai',
                    18 => 'Ramanathapuram',
                    19 => 'Salem',
                    20 => 'Sivaganga',
                    21 => 'Thanjavur',
                    22 => 'Theni',
                    23 => 'Thoothukudi (Tuticorin)',
                    24 => 'Tiruchirappalli',
                    25 => 'Tirunelveli',
                    26 => 'Tiruppur',
                    27 => 'Tiruvallur',
                    28 => 'Tiruvannamalai',
                    29 => 'Tiruvarur',
                    30 => 'Vellore',
                    31 => 'Viluppuram',
                    32 => 'Virudhunagar',
                ),
            ),
            'TG' =>
            array(
                'name' => 'Telangana',
                'districts' =>
                array(
                    1 => 'Adilabad',
                    2 => 'Bhadradri Kothagudem',
                    3 => 'Hyderabad',
                    4 => 'Jagtial',
                    5 => 'Jangaon',
                    6 => 'Jayashankar Bhoopalpally',
                    7 => 'Jogulamba Gadwal',
                    8 => 'Kamareddy',
                    9 => 'Karimnagar',
                    10 => 'Khammam',
                    11 => 'Komaram Bheem Asifabad',
                    12 => 'Mahabubabad',
                    13 => 'Mahabubnagar',
                    14 => 'Mancherial',
                    15 => 'Medak',
                    16 => 'Medchal',
                    17 => 'Nagarkurnool',
                    18 => 'Nalgonda',
                    19 => 'Nirmal',
                    20 => 'Nizamabad',
                    21 => 'Peddapalli',
                    22 => 'Rajanna Sircilla',
                    23 => 'Rangareddy',
                    24 => 'Sangareddy',
                    25 => 'Siddipet',
                    26 => 'Suryapet',
                    27 => 'Vikarabad',
                    28 => 'Wanaparthy',
                    29 => 'Warangal (Rural)',
                    30 => 'Warangal (Urban)',
                    31 => 'Yadadri Bhuvanagiri',
                ),
            ),
            'TR' =>
            array(
                'name' => 'Tripura',
                'districts' =>
                array(
                    1 => 'Dhalai',
                    2 => 'Gomati',
                    3 => 'Khowai',
                    4 => 'North Tripura',
                    5 => 'Sepahijala',
                    6 => 'South Tripura',
                    7 => 'Unakoti',
                    8 => 'West Tripura',
                ),
            ),
            'UK' =>
            array(
                'name' => 'Uttarakhand',
                'districts' =>
                array(
                    1 => 'Almora',
                    2 => 'Bageshwar',
                    3 => 'Chamoli',
                    4 => 'Champawat',
                    5 => 'Dehradun',
                    6 => 'Haridwar',
                    7 => 'Nainital',
                    8 => 'Pauri Garhwal',
                    9 => 'Pithoragarh',
                    10 => 'Rudraprayag',
                    11 => 'Tehri Garhwal',
                    12 => 'Udham Singh Nagar',
                    13 => 'Uttarkashi',
                ),
            ),
            'UP' =>
            array(
                'name' => 'Uttar Pradesh',
                'districts' =>
                array(
                    1 => 'Agra',
                    2 => 'Aligarh',
                    3 => 'Allahabad',
                    4 => 'Ambedkar Nagar',
                    5 => 'Amethi (Chatrapati Sahuji Mahraj Nagar)',
                    6 => 'Amroha (J.P. Nagar)',
                    7 => 'Auraiya',
                    8 => 'Azamgarh',
                    9 => 'Baghpat',
                    10 => 'Bahraich',
                    11 => 'Ballia',
                    12 => 'Balrampur',
                    13 => 'Banda',
                    14 => 'Barabanki',
                    15 => 'Bareilly',
                    16 => 'Basti',
                    17 => 'Bhadohi',
                    18 => 'Bijnor',
                    19 => 'Budaun',
                    20 => 'Bulandshahr',
                    21 => 'Chandauli',
                    22 => 'Chitrakoot',
                    23 => 'Deoria',
                    24 => 'Etah',
                    25 => 'Etawah',
                    26 => 'Faizabad',
                    27 => 'Farrukhabad',
                    28 => 'Fatehpur',
                    29 => 'Firozabad',
                    30 => 'Gautam Buddha Nagar',
                    31 => 'Ghaziabad',
                    32 => 'Ghazipur',
                    33 => 'Gonda',
                    34 => 'Gorakhpur',
                    35 => 'Hamirpur',
                    36 => 'Hapur (Panchsheel Nagar)',
                    37 => 'Hardoi',
                    38 => 'Hathras',
                    39 => 'Jalaun',
                    40 => 'Jaunpur',
                    41 => 'Jhansi',
                    42 => 'Kannauj',
                    43 => 'Kanpur Dehat',
                    44 => 'Kanpur Nagar',
                    45 => 'Kanshiram Nagar (Kasganj)',
                    46 => 'Kaushambi',
                    47 => 'Kushinagar (Padrauna)',
                    48 => 'Lakhimpur - Kheri',
                    49 => 'Lalitpur',
                    50 => 'Lucknow',
                    51 => 'Maharajganj',
                    52 => 'Mahoba',
                    53 => 'Mainpuri',
                    54 => 'Mathura',
                    55 => 'Mau',
                    56 => 'Meerut',
                    57 => 'Mirzapur',
                    58 => 'Moradabad',
                    59 => 'Muzaffarnagar',
                    60 => 'Pilibhit',
                    61 => 'Pratapgarh',
                    62 => 'RaeBareli',
                    63 => 'Rampur',
                    64 => 'Saharanpur',
                    65 => 'Sambhal (Bhim Nagar)',
                    66 => 'Sant Kabir Nagar',
                    67 => 'Shahjahanpur',
                    68 => 'Shamali (Prabuddh Nagar)',
                    69 => 'Shravasti',
                    70 => 'Siddharth Nagar',
                    71 => 'Sitapur',
                    72 => 'Sonbhadra',
                    73 => 'Sultanpur',
                    74 => 'Unnao',
                    75 => 'Varanasi',
                ),
            ),
            'WB' =>
            array(
                'name' => 'West Bengal',
                'districts' =>
                array(
                    1 => 'Alipurduar',
                    2 => 'Bankura',
                    3 => 'Birbhum',
                    4 => 'Cooch Behar',
                    5 => 'Dakshin Dinajpur (South Dinajpur)',
                    6 => 'Darjeeling',
                    7 => 'Hooghly',
                    8 => 'Howrah',
                    9 => 'Jalpaiguri',
                    10 => 'Jhargram',
                    11 => 'Kalimpong',
                    12 => 'Kolkata',
                    13 => 'Malda',
                    14 => 'Murshidabad',
                    15 => 'Nadia',
                    16 => 'North 24 Parganas',
                    17 => 'Paschim Medinipur (West Medinipur)',
                    18 => 'Paschim (West) Burdwan (Bardhaman)',
                    19 => 'Purba Burdwan (Bardhaman)',
                    20 => 'Purba Medinipur (East Medinipur)',
                    21 => 'Purulia',
                    22 => 'South 24 Parganas',
                    23 => 'Uttar Dinajpur (North Dinajpur)',
                ),
            ),
        );

        foreach ($IndianStates as $key => $state) {
            $stateId =  State::create(['name' => $state['name'], 'code' => $key, 'status' => rand(0, 1)]);

            foreach ($state['districts'] as $dist) {
                District::create(['name' => $dist, 'state_id' => $stateId->id, 'status' => rand(0, 1)]);
            }
        }
    }
}
