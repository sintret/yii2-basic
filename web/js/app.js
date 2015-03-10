/* 
 * app js for adi adrian
 * author andy fitria<sintret@gmail.com>
 * sintret.com for programming
 */
$("#selectBranch").on("change", function () {
    var val = $(this).val();
    location.href = "/site/redirect/branchId=" + val;
})

