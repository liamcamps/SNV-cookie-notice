<style type="text/css">
	<?php if (get_field('cookie_notice_made_with_stack','option')) { ?>
		.card {
		    position: relative;
		    display: flex;
		    flex-direction: column;
		    min-width: 0;
		    word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
		    border: 1px solid #000;
		    -webkit-transition: transform .2s ease;
		    -o-transition: transform .2s ease;
		    transition: transform .2s ease;
		}

		.card:hover {
		    -webkit-transform: scale(1.025);
		    -ms-transform: scale(1.025);
		    -o-transform: scale(1.025);
		    transform: scale(1.025);
		}

		.card .card-body {
		    cursor: pointer;
		    flex: 1 1 auto;
		    padding: 1.25rem;
		}

		.custom-control {
		  position: relative;
		  display: block;
		  min-height: 1.5rem;
		  padding-left: 1.5rem;
		}

		.custom-control-inline {
		  display: -ms-inline-flexbox;
		  display: inline-flex;
		  margin-right: 1rem;
		}

		.custom-control-input {
		  position: absolute;
		  z-index: -1;
		  opacity: 0;
		}

		.custom-control-input:checked ~ .custom-control-label::before {
		  color: #fff;
		  background-color: <?php echo get_field('cookie_notice_background','option') ? get_field('cookie_notice_background','option') : '#007bff'; ?>;
		}

		.custom-control-input:active ~ .custom-control-label::before {
		  color: #fff;
		  background-color: #b3d7ff;
		}

		.custom-control-input:disabled ~ .custom-control-label {
		  color: #6c757d;
		}

		.custom-control-input:disabled ~ .custom-control-label::before {
		  background-color: #e9ecef;
		}

		.custom-control-label {
		  position: relative;
		  margin-bottom: 0;
		  font-size: 1rem;
		  width: 100%;
		  cursor: pointer;
		}

		.custom-control-label::before {
		  position: absolute;
		  top: 0.3rem;
		  left: -1.75rem;
		  display: block;
		  width: 1.1429rem;
		  height: 1.1429rem;
		  pointer-events: none;
		  content: "";
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		  background-color: transparent;
		  border: 1px solid #ccc;
		}

		.custom-control-label::after {
		  position: absolute;
		  top: 0.3rem;
		  left: -1.75rem;
		  display: block;
		  width: 1.1429rem;
		  height: 1.1429rem;
		  content: "";
		  background-repeat: no-repeat;
		  background-position: center center;
		  background-size: 50% 50%;
		}

		.custom-radio .custom-control-label::before {
		  border-radius: 50%;
		}

		.custom-radio .custom-control-input:checked ~ .custom-control-label::before {
		  background-color: <?php echo get_field('cookie_notice_background','option') ? get_field('cookie_notice_background','option') : '#007bff'; ?>;
		  border: 0;
		}

		.custom-radio .custom-control-input:checked ~ .custom-control-label::after {
		  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='%23fff'/%3E%3C/svg%3E");
		}

		.custom-radio .custom-control-input:disabled:checked ~ .custom-control-label::before {
		  background-color: rgba(0, 123, 255, 0.5);
		}

		.btn.btn-primary {
		    background: <?php echo get_field('cookie_notice_background','option') ? get_field('cookie_notice_background','option') : '#007bff'; ?>;
		    border: 0;
		    border-radius: 0;
		}

		form.cookie-form ul {
		    padding-left: 20px;
		    list-style: disc;
		}
	<?php } ?>
</style>