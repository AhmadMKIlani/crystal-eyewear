"use strict";
var KTproductsList = (function () {
	var e,
		t,
		n,
		r, 
		o = document.getElementById("kt_table_products"),
		c = () => {
			o.querySelectorAll('[data-kt-delete="delete_row"]').forEach(
				(t) => {
					t.addEventListener("click", function (t) {
						t.preventDefault();
						const n = t.target.closest("tr"),
							r = n
								.querySelectorAll("td")[0]
								.querySelectorAll("a")[0].innerText;
						Swal.fire({
							text: "Are you sure you want to delete " + r + "?",
							icon: "warning",
							showCancelButton: !0,
							buttonsStyling: !1,
							confirmButtonText: "Yes, delete!",
							cancelButtonText: "No, cancel",
							customClass: {
								confirmButton: "btn fw-bold btn-danger",
								cancelButton: "btn fw-bold btn-active-light-primary",
							},
						}).then(function (t) {
							t.value
								? Swal.fire({
										text: "You have deleted " + r + "!.",
										icon: "success",
										buttonsStyling: !1,
										confirmButtonText: "Ok, got it!",
										customClass: { confirmButton: "btn fw-bold btn-primary" },
								  })
										.then(function () {
											e.row($(n)).remove().draw();
										})
										.then(function () {
											a();
										})
								: "cancel" === t.dismiss &&
								  Swal.fire({
										text: customerName + " was not deleted.",
										icon: "error",
										buttonsStyling: !1,
										confirmButtonText: "Ok, got it!",
										customClass: { confirmButton: "btn fw-bold btn-primary" },
								  });
						});
					});
				}
			);
		},
		l = () => {
			const c = o.querySelectorAll('[type="checkbox"]');
			(t = document.querySelector('[data-kt-product-table-toolbar="base"]')),
				(n = document.querySelector('[data-kt-product-table-toolbar="selected"]')),
				(r = document.querySelector(
					'[data-kt-product-table-select="selected_count"]'
				));
			const s = document.querySelector(
				'[data-kt-product-table-select="delete_selected"]'
			);
			c.forEach((e) => {
				e.addEventListener("click", function () {
					setTimeout(function () {
						a();
					}, 50);
				});
			}),
				s.addEventListener("click", function () {
					Swal.fire({
						text: "Are you sure you want to delete selected customers?",
						icon: "warning",
						showCancelButton: !0,
						buttonsStyling: !1,
						confirmButtonText: "Yes, delete!",
						cancelButtonText: "No, cancel",
						customClass: {
							confirmButton: "btn fw-bold btn-danger",
							cancelButton: "btn fw-bold btn-active-light-primary",
						},
					}).then(function (t) {
						t.value
							? Swal.fire({
									text: "You have deleted all selected customers!.",
									icon: "success",
									buttonsStyling: !1,
									confirmButtonText: "Ok, got it!",
									customClass: { confirmButton: "btn fw-bold btn-primary" },
							  })
									.then(function () {
										c.forEach((t) => {
											t.checked &&
												e
													.row($(t.closest("tbody tr")))
													.remove()
													.draw();
										});
										o.querySelectorAll('[type="checkbox"]')[0].checked = !1;
									})
									.then(function () {
										a(), l();
									})
							: "cancel" === t.dismiss &&
							  Swal.fire({
									text: "Selected customers was not deleted.",
									icon: "error",
									buttonsStyling: !1,
									confirmButtonText: "Ok, got it!",
									customClass: { confirmButton: "btn fw-bold btn-primary" },
							  });
					});
				});
		};
	const a = () => {
		const e = o.querySelectorAll('tbody [type="checkbox"]');
		let c = !1,
			l = 0;
		e.forEach((e) => {
			e.checked && ((c = !0), l++);
		}),
			c
				? ((r.innerHTML = l),
				  t.classList.add("d-none"),
				  n.classList.remove("d-none"))
				: (t.classList.remove("d-none"), n.classList.add("d-none"));
	};
	return {
		init: function () {
			o &&
				(o.querySelectorAll("tbody tr").forEach((e) => {
					const t = e.querySelectorAll("td"),
						n = t[4].innerText.toLowerCase();
					let r = 0,
						o = "minutes";
					n.includes("yesterday")
						? ((r = 1), (o = "days"))
						: n.includes("mins")
						? ((r = parseInt(n.replace(/\D/g, ""))), (o = "minutes"))
						: n.includes("hours")
						? ((r = parseInt(n.replace(/\D/g, ""))), (o = "hours"))
						: n.includes("days")
						? ((r = parseInt(n.replace(/\D/g, ""))), (o = "days"))
						: n.includes("weeks") &&
						  ((r = parseInt(n.replace(/\D/g, ""))), (o = "weeks"));
					const c = moment().subtract(r, o).format();
					t[4].setAttribute("data-order", c);
					const l = moment(t[5].innerHTML, "DD MMM YYYY, LT").format();
					t[6].setAttribute("data-order", l);
				}),
				(e = $(o).DataTable({
                    info: !1,
                    order: [],
                    pageLength: 7,
                    lengthChange: !1,
                    columnDefs: [{
                        orderable: !1,
                        targets: 6
                    }],
				})).on("draw", function () {
					l(), c(), a();
				}),
				l());
		},
	};
})();
KTUtil.onDOMContentLoaded(function () {
	KTproductsList.init();
});
