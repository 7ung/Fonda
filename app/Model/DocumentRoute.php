<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 11:32 AM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Responses\ResponseBuilder;
use Responses\ResponseJsonBadRequest;

require_once __DIR__.'/../Responses/_loader.php';

class DocumentRoute
{
     static $route = [] ;

    static function route($name, $uri, $method, $params = [], $desc = '', $successResponse, $failResponse)
    {
        self::$route[$name] = array(
            'name' => $name,
            'uri' => $uri,
            'method' => $method,
            'params' => $params,
            'description' => $desc,
            'success' => ($successResponse instanceof Model) ? ($successResponse->jsonName.': '.$successResponse->toJson()) : $successResponse,
//            'success' => (($successResponse instanceof Model) ? ($successResponse->jsonName) : '').': '.$successResponse->toJson() ,
            'fail' => $failResponse
        );
    }

}

DocumentRoute::route('Register', '/register', 'POST',
    // params
    [
        ['username', 'required', 'Tên đăng nhập'],
        ['email', 'required', 'Email xác thực tài khoản'],
        ['password', 'required', 'Mật khẩu đăng nhập'],
    ],
    // Description
    'Đăng ký thành viên',
    // Sucess Response
    VerifyStatus::dumm(),
    // Error Response
    [
        [40001, 'Thiếu param username'],
        [40002, 'Thiếu param email'],
        [40003, 'Thiếu param password'],
        [40901, 'Username đã tồn tại'],
        [40902, 'Email đã tồn tại'],

    ]
);

DocumentRoute::route('Login', '/login', 'POST',
    // params
    [
        ['username', 'required', 'Tên đăng nhập'],
        ['password', 'required', 'Mật khẩu đăng nhập'],
    ],
    // Description
    'Đăng nhập',
    // Sucess Response
    AccessToken::dumm(),
    // Error Response
    [
        [40001, 'Thiếu param username'],
        [40003, 'Thiếu param password'],
        [40101, 'Sai username hoặc password'],
        [40102, 'Account chưa được kích hoạt'],
    ]
);

DocumentRoute::route('Logout', '/logout', 'GET',
        // params
        [
            ['token', 'required (query)', 'Mã xác thực tài khoản đã đăng nhập'],
        ],
        // Description
        'Đăng xuất - Chú ý: Logout sẽ xoá token',
        // Sucess Response
        'empty - chỉ trả về mã 200 và message',
        // Error Response
        [
            [40300, 'Sai mã xác thực'],
        ]
);


DocumentRoute::route('Verify account', '/users/{id}/verify', 'PUT',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['code', 'required', 'Mã xác thực tài khoản được gửi vào email xác thực'],
    ],
    // Description
    'Kích hoạt tài khoản',
    // Sucess Response
    VerifyStatus::dumm(),
    // Error Response
    [
        [40004, 'Thiếu token param'],
        [40404, 'Sai user id'],
    ]
);

DocumentRoute::route('Resend verify code', '/users/{id}/verify', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Gửi lại mã xác thực vào email xác thực',
    // Sucess Response
    VerifyStatus::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40903, 'Account đã được xác thực'],
    ]
);

DocumentRoute::route('Forgot password', '/resend_password', 'GET',
    // params
    [
        ['username', 'required (query)', 'Tên đăng nhập'],
        ['email', 'required (query)', 'Email kiểm tra người dùng có đúng chủ sở hữu'],
    ],
    // Description
    'Gửi password mới vào email xác thục',
    // Sucess Response
    User::dumm(),
    // Error Response
    [
        [40001, 'Thiếu param username'],
        [40002, 'Thiếu param email'],
        [40401, 'Khôgn tìm thấy user'],
        [40402, 'Sai email'],
    ]
);

DocumentRoute::route('Update password', '/update_password', 'POST',
    // params
    [
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['password', 'required', 'Password mới'],
    ],
    // Description
    'Cập nhật password mới của người dùng',
    // Sucess Response
    User::dumm(),
    // Error Response
    [
        [40003, 'Thiếu param password'],
        [40300, 'Sai mã xác thực'],
    ]
);

DocumentRoute::route('Get user profile', '/users/{id}/profile', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Lấy thông tin cá nhân của người dùng theo id',
    // Sucess Response
    Profile::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
    ]
);

DocumentRoute::route('Get user profile by Token', '/users/profile', 'POST',
    // params
    [
        ['token', 'required', 'token'],
    ],
    // Description
    'Lấy thông tin cá nhân của người dùng theo token',
    // Sucess Response
    Profile::dumm(),
    // Error Response
    [
        [40403, 'Sai user id'],
    ]
);


DocumentRoute::route('Update user profile', '/users/{id}/profile', 'PUT',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required ', 'Mã xác thực tài khoản đã đăng nhập'],
        ['first_name', 'non-required', 'Tên'],
        ['last_name', 'non-required', 'Họ'],
        ['birth', 'non-required', 'Format yyyy-MM-dd'],
        ['gender', 'non-required', 'male, female, unknown'],
        ['profile_picture_id', 'non-required', 'male, female, unknown'],

    ],
    // Description
    'Cập nhật thông tin cá nhân của người dùng theo id',
    // Sucess Response
    Profile::dumm(),
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image']
    ]
);


DocumentRoute::route('Get location', '/users/{id}/location', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Lấy danh sách địa điểm của người dùng',
    // Sucess Response
    Location::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
    ]
);

DocumentRoute::route('Create location', '/users/{id}/location', 'POST',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['longitude', 'required', 'Kinh độ'],
        ['latitude', 'required', 'Vĩ độ'],
        ['city', 'non-required', 'Tên thành phố'],
        ['address', 'non-required', 'Địa chỉ cụ thể']

    ],
    // Description
    'Thêm một địa điểm của người dùng',
    // Sucess Response
    Location::dummMany(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40005, 'Thiếu param longitude'],
        [40006, 'Thiếu param latitude'],

    ]
);

DocumentRoute::route('Get single location', '/users/{id}/location/{location_id}', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['location_id', 'required (query)', 'Location id']

    ],
    // Description
    'Lấy một location của người dùng theo id',
    // Sucess Response
    Location::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40405, 'Thiếu param location id'],
        [40905, 'Sai location id hoặc user id']
    ]
);

DocumentRoute::route('Delete location', '/users/{id}/location/{location_id}', 'DELETE',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['location_id', 'required (query)', 'Location id']

    ],
    // Description
    'Xoá một địa điểm của người dùng theo id',
    // Sucess Response
    'empty - chỉ trả về mã 200 và message',
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40405, 'Thiếu param location id'],
        [40905, 'Sai location id hoặc user id']
    ]
);



DocumentRoute::route('Get image', '/users/{id}/image', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Lấy danh sách image của người dùng',
    // Sucess Response
    Image::dummMany(),
    // Error Response
    [
        [40404, 'Sai user id'],
    ]
);


DocumentRoute::route('Upload image', '/users/{id}/image', 'POST',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['image_base64', 'required', 'Mã base64 của hình ảnh - Chú ý: phải có prefix: data:image/jpeg;base64,'],
        ['description', 'non-required', 'Miêu tả thông tin hình ảnh'],

    ],
    // Description
    'Upload một ảnh của người dùng (ảnh profile)',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40007, 'Thiếu param image_base64'],
        [40008, 'Sai format ảnh base64'],
    ]
);


DocumentRoute::route('Upload image', '/users/{id}/image', 'POST',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['image_base64', 'required', 'Mã base64 của hình ảnh - Chú ý: phải có prefix: data:image/jpeg;base64,'],
        ['description', 'non-required', 'Miêu tả thông tin hình ảnh'],

    ],
    // Description
    'Upload một ảnh của người dùng (ảnh profile)',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40007, 'Thiếu param image_base64'],
    ]
);


DocumentRoute::route('Get single image', '/users/{id}/image/{image_id}', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['image_id', 'required (query)', 'Image id']
    ],
    // Description
    'Lấy thông tin ảnh theo id',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image'],
        [40906, 'Image và user không khớp']
    ]
);

DocumentRoute::route('Update single image', '/users/{id}/image/{image_id}', 'PUT',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['image_id', 'required (query)', 'Image id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['description', 'non-required','Nội dung miêu tả của ảnh']
    ],
    // Description
    'Update thông tin ảnh theo id',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image'],
        [40300, 'Sai mã xác thực'],
        [40906, 'Image và user không khớp']
    ]
);


DocumentRoute::route('Delete image', '/users/{id}/image/{image_id}', 'DELETE',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['image_id', 'required (query)', 'Image id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
    ],
    // Description
    'delete ảnh theo id',
    // Sucess Response
    'empty - chỉ trả về mã 200 và message',
    // Error Response
    [
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image'],
        [40300, 'Sai mã xác thực'],
        [40906, 'Image và user không khớp'],
        [40907, 'Không được xoá profile picture']
    ]
);

// FondaController@store
DocumentRoute::route('Create Fonda', '/fonda', 'POST',
    // params
    [
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập, tài user phải có quyền Vendor'],
        ['name', 'required', 'Tên của fonda'],
        ['group_name', 'non-required', 'Tên Fonda'],
        ['group_id', 'required', 'Nhóm Fonda. Required nếu không có group_name'],
        ['scale', 'required', 'Quy mô của fonda, nhận giá trị 1, 2, 3'],
        ['open_time', 'non-required', 'Giờ mở cửa'],
        ['close_time', 'non-required', 'Giờ đóng cửa. open time và close time không required nhưng nếu có, thì phải có cả hai. Format: hh:mm:ss'],
        ['open_day','non-required', 'Ngày mở cửa trong tuần. Giá trị <= 127  (127 = bx1111111)'],
        ['phone_1', 'non-required', 'Số điện thoại fonda'],
        ['phone_2', 'non-required', 'Số điện thoại fonda'],
        ['location', 'non-required', 'Địa điểm của fonda, format: longitude,latitude,city hoặc longitude,latitude (city không required, dùng dấu "," làm phân cách)'],
        ['address', 'non-required', 'Đại chỉ của fonda. Không cótác dụng nếu không có location']
    ],
    // Description
    'Tạo một cửa hàng',
    // Sucess Response
    Fonda::dumm(),
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40301, 'User không có quyền Vendor'],
        [40010, 'Thiếu param name'],
        [40011, 'Thiếu param group_id'],
        [40012, 'Thiếu param scale'],
        [40013, 'Param scale sai giá trị'],
        [40014, 'Sai định dạng giờ'],
        [40015, 'Sai định dạng location'],
        [40016, 'Sai định dạng ngày trong tuần'],
        [40411, 'Không tìm thấy group'],
        [40914, 'Giờ đóng cưa phải lớn hơn giờ mở cửa'],
    ]
);

// FondaController@store
DocumentRoute::route('Update Fonda', '/fonda/{id}', 'UPDATE',
    // params
    [
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập, tài user phải có quyền Vendor'],
        ['id', 'required (query)', 'Id của fonda muốn cập nhật'],
        ['name', 'non-required', 'Tên của fonda'],
        ['group_id', 'non-required', 'Nhóm Fonda'],
        ['scale', 'non-required', 'Quy mô của fonda, nhận giá trị 1, 2, 3'],
        ['open_time', 'non-required', 'Giờ mở cửa'],
        ['close_time', 'non-required', 'Giờ đóng cửa. open time và close time không required nhưng nếu có, thì phải có cả hai. Format: hh:mm:ss'],
        ['open_day','non-required', 'Ngày mở cửa trong tuần. Giá trị <= 127  (127 = bx1111111)'],
        ['phone_1', 'non-required', 'Số điện thoại fonda'],
        ['phone_2', 'non-required', 'Số điện thoại fonda'],
        ['location', 'non-required', 'Địa điểm của fonda, format: longitude,latitude,city hoặc longitude,latitude (city không required, dùng dấu "," làm phân cách)'],
        ['active', 'non-active', 'Trạng thái, =1 thì active, =0 thì deactive']
    ],
    // Description
    'Cập nhật một cửa hàng',
    // Sucess Response
    Fonda::dumm(),
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40301, 'User không có quyền Vendor'],
        [40010, 'Thiếu param name'],
        [40011, 'Thiếu param group_id'],
        [40012, 'Thiếu param scale'],
        [40013, 'Param scale sai giá trị'],
        [40014, 'Sai định dạng giờ'],
        [40015, 'Sai định dạng location'],
        [40016, 'Sai định dạng ngày trong tuần'],
        [40311, 'User không có quyền chỉnh sửa thông tin này'],
        [40411, 'Không tìm thấy group'],
        [40914, 'Giờ đóng cưa phải lớn hơn giờ mở cửa'],
    ]
);


// FondaController@store
DocumentRoute::route('GET single Fonda', '/fonda/{id}', 'GET',
    // params
    [
        ['id', 'required (query)', 'Id của fonda muốn cập nhật']
    ],
    // Description
    'Lất thông tin một cửa hàng',
    // Sucess Response
    Fonda::dumm(),
    // Error Response
    [
        [40410, 'Không tìm thấy fonda'],
    ]
);

// FondaController@store
DocumentRoute::route('GET list Fonda', '/fonda', 'GET',
    // params
    [
        ['name', 'non-required', 'Tên của fonda'],
        ['group_name', 'non-required', 'Tên Nhóm Fonda'],
        ['scale', 'non-required', 'Quy mô của fonda, nhận giá trị 1, 2, 3'],
        ['city', 'non-required', 'Tên thành phố (so sánh chính xác)'],
        ['address', 'non-required', 'Địa chỉ (nếu có chứa)'],
        ['is_sale', 'non-required', 'Có khuyến mại hay không 0 hoặc 1'],
        ['culirary_id', 'non-required', 'Id của nhóm ẩm thực'],
        ['dainty', 'non-required', 'Tên món'],
    ],
    // Description
    'Lất danh sách một cửa hàng (pagine = 4) - Chú ý: các param giúp lọc thông tin (tìm kiếm)',
    // Sucess Response
    'quá phức tạp để thể hiện - hảy test bằng request: http://'.$_SERVER['HTTP_HOST'].'/fonda',
    // Error Response
    [

    ]
);


DocumentRoute::route('Get list image of fonda', '/fonda/{id}/image', 'GET',
    // params
    [
        ['id', 'required (query)', 'Fonda id'],
    ],
    // Description
    'Lấy danh sách các hình ảnh theo fonda id',
    // success repsonse
    ImageFonda::dummMany(),
    // Error Response
    [
        [40411, 'Không tìm thấy fonda'], // midw - fonda_res
    ]
);


DocumentRoute::route('Get single image of fonda', '/fonda/{id}/image/{image_id}', 'GET',
    // params
    [
        ['id', 'required (query)', 'Fonda id'], // midw - fonda_res
        ['image_id', 'required (query)', 'Fonda Image Id'], // midw - fonda_image_res
    ],
    // Description
    'Lấy một hình ảnh theo fonda id và image id',
    // success repsonse
    ImageFonda::dumm(),
    // Error Response
    [
        [40411, 'Không tìm thấy fonda'], // midw - fonda_res
        [40412, 'Không tìm thấy image'], // midw - fonda_image_res
    ]
);

DocumentRoute::route('Upload image of fonda', '/fonda/{id}/image', 'POST',
    // params
    [
        ['id', 'required (query)', 'Fonda id'], // midw - fonda_res
        ['token', 'required', 'Mã xác thực tài khoản'],
        ['image_base64', 'required', 'Mã base64 của ảnh'],
        ['description', 'non-required', 'Nội dung mô tả'],
    ],
    // Description
    'Đăng một hình ảnh cho fonda',
    // success repsonse
    ImageFonda::dumm(),
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40411, 'Không tìm thấy fonda'], // midw - fonda_res
        [40301, 'User không có quyền Vendor'],
        [40007, 'Thiếu param image_base64'],
        [40008, 'Sai format ảnh base64'],
    ]
);

DocumentRoute::route('Update image of fonda', '/fonda/{id}/image/{image_id}', 'PUT',
    // params
    [
        ['id', 'required (query)', 'Fonda id'], // midw - fonda_res
        ['image_id', 'required (query)', 'image id'],
        ['token', 'required', 'Mã xác thực tài khoản'],
        ['description', 'non-required', 'Nội dung mô tả'],
    ],
    // Description
    'Cập nhật một hình ảnh cho fonda',
    // success repsonse
    ImageFonda::dumm(),
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40411, 'Không tìm thấy fonda'], // midw - fonda_res
        [40301, 'User không có quyền Vendor'],
        [40412, 'Không tìm thấy ảnh'],
        [40912, 'Không có quyền truy cập ảnh'],
    ]
);

DocumentRoute::route('Delete image of fonda', '/fonda/{id}/image/{image_id}', 'DELETE',
    // params
    [
        ['id', 'required (query)', 'Fonda id'], // midw - fonda_res
        ['image_id', 'required (query)', 'image id'],
        ['token', 'required', 'Mã xác thực tài khoản'],
    ],
    // Description
    'Xoá một hình ảnh cho fonda',
    // success repsonse
    'Mã 200 và message success',
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40411, 'Không tìm thấy fonda'], // midw - fonda_res
        [40301, 'User không có quyền Vendor'],
        [40412, 'Không tìm thấy ảnh'],
        [40912, 'Không có quyền truy cập ảnh'],
    ]
);

DocumentRoute::route('Get list of fonda group', '/fonda_group', 'GET',
    // params
    [
        ['name', 'required (query)', 'Tìm kiếm theo tên group'],
    ],
    // Description
    'Lấy danh sách fonda group - optional: lọc theo tên',
    FondaGroup::all()->toJson(),
    []
);

DocumentRoute::route('Crreate fonda group', '/fonda_group', 'POST',
    // params
    [
        ['name', 'required', 'Tên fonda group'],
    ],
    // Description
    'Tạo một group',
    FondaGroup::dumm(),
    [
        [40018, 'Thiếu tên group']
    ]
);

DocumentRoute::route('Get list fonda sale', '/fonda/{id}/sale', 'GET',
    [
        ['id','required (query)', 'Fonda id']
    ],
    'Lấy danh sách các chương trình khuyến mại của một fonda',
    '...',
    [
        [40300, ResponseJsonBadRequest::$errosMessage[40300]],
        [40301, ResponseJsonBadRequest::$errosMessage[40301]],
        [40410, ResponseJsonBadRequest::$errosMessage[40410]],
        [40311, ResponseJsonBadRequest::$errosMessage[40311]],
    ]
);

DocumentRoute::route('Get single fonda sale', '/fonda/{id}/sale/{sale_id}', 'GET',
    [
        ['id','required (query)', 'Fonda id'],
        ['sale_id','required (query)', 'Fonda sale id']
    ],
    'Lấy một chương trình khuyến mại theo id và fonda id',
    Sale::dumm(),
    [
        [40300, ResponseJsonBadRequest::$errosMessage[40300]],
        [40301, ResponseJsonBadRequest::$errosMessage[40301]],
        [40311, ResponseJsonBadRequest::$errosMessage[40311]],
        [40410, ResponseJsonBadRequest::$errosMessage[40410]],
        [40413, ResponseJsonBadRequest::$errosMessage[40413]],
    ]
);

DocumentRoute::route('Get list utility', '/utility', 'GET',
    [
        ['name','non-required ', 'Lọc theo tên']
    ],
    'Lấy list utility, lọc theo tên',
    '....',
    [

    ]
);

DocumentRoute::route('Create utility', '/utility', 'POST',
    [
        ['name','required ', 'tên']
    ],
    'Lưu một utility',
    '....',
    [
        [40018, ResponseJsonBadRequest::$errosMessage[40018]],
    ]
);

DocumentRoute::route('Get list fonda utility', '/fonda/{id}/utility', 'GET',
    [
    ],
    'Get list fonda utility',
    '....',
    [
    ]
);

DocumentRoute::route('Get single utility', '/fonda/{id}/utility/{utility_id}', 'GET',
    [
    ],
    'Lấy một  utility',
    'Danh sách utility theo fonda-id (collections)',
    [

    ]
);

DocumentRoute::route('Create utility', '/fonda/{id}/utility', 'POST',
    [
        ['utility_name','non-required', 'Tên của utility mới'],
        ['utility_id','required', 'Id của utility đã tồn tại. Required nếu không có utility name'],
        ['description','non-required', ''],
    ],
    'Tạo một  utility',
    '....',
    [
        [40300, 'Sai token '],
        [40410, 'Không tìm thấy fonda'],
        [40311, 'User không có quyền truy cập']
    ]
);

DocumentRoute::route('Delete single utility', '/fonda/{id}/utility/{utility_id}', 'DELETE',
    [
    ],
    'Xoá một  utility',
    '....',
    [
    ]
);

DocumentRoute::route('Update single utility', '/fonda/{id}/utility/{utility_id}', 'UPDATE',
    [
        ['description','non-required', ''],
    ],
    'SỬA một  utility',
    '....',
    [
    ]
);


DocumentRoute::route('Get list culinary', '/culinary', 'GET',
    [
        ['name','non-required ', 'Lọc theo tên']
    ],
    'Lấy list culinary, lọc theo tên',
    '....',
    [

    ]
);

DocumentRoute::route('Create culinary', '/culinary', 'POST',
    [
        ['name','required ', 'tên']
    ],
    'Lưu một culinary',
    '....',
    [
    ]
);


DocumentRoute::route('Get single culinary', '/fonda/{idculinary/{culinary_id}', 'GET',
    [
    ],
    'Lấy một  culinary',
    '....',
    [
    ]
);

DocumentRoute::route('Create culinary', '/fonda/{id}/culinary', 'POST',
    [
        ['culinary_name','non-required', 'Tên loại ẩm thực'],
        ['culinary_id','required', 'Id của loại ẩm thực, required nếu không có culinary name'],
    ],
    'Tạo một  culinary',
    '....',
    [
    ]
);

DocumentRoute::route('Delete single culinary', '/fonda/{id}/culinary/{culinary_id}', 'DELETE',
    [
    ],
    'Xoá một  culinary',
    '....',
    [
    ]
);


DocumentRoute::route('Create Comment', '/user/{id}/comment', 'POST',
    [
        ['content', 'required', 'Nội dung comment'],
        ['token', 'required', 'token']
    ],
    'Đăng một comment',
    Comment::find(2),
    [
        [40026, ResponseJsonBadRequest::$errosMessage[40026]],
        [40027, ResponseJsonBadRequest::$errosMessage[40027]],
        [40410, ResponseJsonBadRequest::$errosMessage[40410]]
    ]
);

DocumentRoute::route('Update Comment', '/user/{id}/comment/{comment_id}', 'PUT',
    [
        ['content', 'non-required', 'Nội dung comment'],
        ['token', 'required', 'token']
    ],
    'Edit một comment',
    Comment::find(2),
    [
        [40026, ResponseJsonBadRequest::$errosMessage[40026]],
        [40426, ResponseJsonBadRequest::$errosMessage[40426]],
    ]
);


DocumentRoute::route('Delete Comment', '/user/{id}/comment/{comment_id}', 'DELETE',
    [
        ['token', 'required', 'token']
    ],
    'Xoá một comment',
    'empty',
    [
        [40426, ResponseJsonBadRequest::$errosMessage[40426]],
    ]
);
DocumentRoute::route('Get list Comment in fonda', '/fonda/{id}/comment', 'GET',
    [
    ],
    'Xoá một comment',
    'empty',
    [
        [40410, ResponseJsonBadRequest::$errosMessage[40410]],
        [40311, ResponseJsonBadRequest::$errosMessage[40311]],
    ]
);

