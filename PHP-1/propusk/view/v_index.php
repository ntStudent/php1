<!DOCTYPE html>
<html>
	<head>
		<title>Заполнить пропуск</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>

		<form>
			<fieldset>
				<legend>Введите ФИО</legend>
				<p>
					<label for="first_name">Введите имя</label>
					<input id="first_name" placeholder="Имя" type="text" name="name1">
					<span></span>
				</p>
				<p>
					<label for="seckond_name">Введите фамилию</label>
					<input id="seckond_name" placeholder="Фамилия" type="text" name="name2">
					<span></span>
				</p>
				<p>
					<label for="last_name">Введите отчество</label>
					<input id="last_name" placeholder="Отчество" type="text" name="name3">
					<span></span>
				</p>
			</fieldset>

			<fieldset>
				<legend>Описание документа</legend>
				<p>
					<label class="doc_name" for="document">Документ удостоверяющий личность: наименование</label>
					<input id="document" placeholder="Наименование докуента" type="text" name="doc">
					<span></span>
				</p>
				<p>
					<label class="doc_seriy" for="seriy_doc">Введите серию документа</label>
					<input id="seriy_doc" placeholder="Серия документа" type="text" name="doc_s">
					<span></span>
				</p>
				<p>
					<label class="doc_num" for="num_doc">Введите номер документа</label>
					<input id="num_doc" placeholder="Номер документа" type="text" name="doc_n">
					<span></span>
				</p>
				<p>
					<label for="org_doc">Когда и кем выдан</label>
					<input id="org_doc" placeholder="Когда и кем выдан" type="text" name="doc_org">
					<span></span>
				</p>
			</fieldset>

			<fieldset>
				<legend>К кому пришел гость</legend>
				<p>
					<label class="master" for="m_man">Должность, Ф.И.О., подпись ответственного сотрудника АО "АВС" за посетителя</label>
					<input id="m_man" placeholder="Должность, Ф.И.О. ответственного" type="text" name="org">
					<span></span>
				</p>
			</fieldset>
			
			<p>
				<input id="button" type="submit" name="but_ton" value="Сохранить">
				<span></span>
			</p>

		</form>

	</body>
</html>