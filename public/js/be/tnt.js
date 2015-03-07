(function ($) {
    $('.checkbox').click(function () {
        if ($('[purpose="giám sát"]').is(':checked'))
            $(".news_number").show();  // checked
        else
            $(".news_number").hide();
    });
    $('[btn-confirm="confirm"]').on('click', function() {
		var dataConfirm = $(this).attr('data-confirm');
		console.log('xoa xoa');
		if (typeof dataConfirm === "undefined") {
			dataConfirm = "Bạn có chắc chắn ?";
		}
		var dataUrl = $(this).attr('data-url');
		bootbox.confirm(dataConfirm, 'Hủy bỏ', 'Đồng ý', function(result) {
			if (result) {
				location.href = dataUrl;
			}
		});
		return false;
	});
        $('.statistics-select-time').on('click', function() {
            console.log('vao day');
           $('.custom-select-time') .show();
        });
    var tableHandle = {
		$tableContainer: $('.table-container'),
		contanerClass: '.table-container',
		$searchInput: $(".table-search-input"),
		init: function() {
			this.$tableContainer.each(function() {
				$container = $(this);
                                // select number of rows on perPage
                                $(this).on('change','.perPage',function() {
                                    $('.table-search-input').trigger('change');
                                });
                                //ajax pagination
				$(this).on('click', '.ajax a', function() {
					$paging = $(this);
                                        searchParmas = {};
                                        searchParmas.keyword = $('.table-search-input').val();
                                        searchParmas.perPage = $('.perPage :selected').text();
					//call ajax to get html content for paging
					$.ajax({
						url: $(this).attr('href'),
						data: searchParmas,
						type: "GET",
						success: function(result) {
							$paging.parents(tableHandle.contanerClass).html(result);
                                                        $(".perPage option:contains("+ searchParmas.perPage + ")").attr('selected', true);
						},
						error: function() {
							bootbox.alert('Đã có lỗi xảy ra, vui lòng đăng nhập lại');
							return false;
						}
					});
					return false;
				});
				//seach on table
				$(this).on('change', '.table-search-input', function() {
					$input = $(this);
					searchParmas = {};
					ignoreArr = ['type', 'placeholder', 'class', 'id', 'data-url'];
					dataUrl = $(this).attr('data-url');
					//add keyword to search params
					searchParmas.keyword = $(this).val();
                                        searchParmas.perPage = $('.perPage :selected').text();
                                        console.log(searchParmas);
					for (k in this.attributes) {
						//get attributes that need to search, to build paramaters for search query
						if (typeof (this.attributes[k].value) !== 'undefined' && $.inArray(this.attributes[k].name, ignoreArr) === -1) {
							attrName = this.attributes[k].name;
							attrValue = this.attributes[k].value;
							searchParmas[attrName] = attrValue;
						}
					}
					//make ajax request 
					$.ajax({
						url: dataUrl,
						type: "GET",
						data: searchParmas,
						success: function(result) {
							$input.parents(tableHandle.contanerClass).html(result);
                                                        $(".perPage option:contains("+ searchParmas.perPage + ")").attr('selected', true);
        
						},
						error: function() {
							bootbox.alert('Đã có lỗi xảy ra, vui lòng kiểm tra lại');
							return false;
						}
					});
				});

			});
		}
	};
    tableHandle.init();
})(jQuery);