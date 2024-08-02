<!-- reusable component 
 

1)  bootbox alert 

success :

bootbox.alert({
    message: "Password Request Successfull!",
    backdrop: true,
    callback: function () {
    }
}).find('.modal-content').addClass("flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800");


error :

 bootbox.alert({
    message: "Login Unsuccessful. Change a few things up and try submitting again.",
    backdrop: true,
    callback: function () {
    }
}).find('.modal-content').addClass("flex items-center p-2 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400").find('.bootbox-close-button').addClass("ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700");




2) return responses from backend 

return response()->json(['status' => 'error', 'message' => 'User account inactive. Contact Administrator to activate your account']);

return response()->json(['status' => 'success']);
-->