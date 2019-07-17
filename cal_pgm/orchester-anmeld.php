<FORM enctype="multipart/form-data"
	action='menue.php?go=tclacontacts&func=user_new' method='post'>
<TABLE border="1"  width="600">
	<TBODY>



		<TR>
			<TD colSpan=2 class="col0">Erfassen Sie die Musiker ihres Orchesters
			für die Festivalorganisation</TD>
		</TR>

		<tr>
			<td width="200"><span style="display: block; padding-top: 7px;">Mitmachen
			am</span></td>
			<td class="checkbox"><input type="checkbox" name="fr" id="fr" /> <label
				for="fr">Freitag 28.09.2009</label> <input type="checkbox" name="sa"
				id="sa" /> <label for="sa">Samstag 29.09.2009</label> <input
				type="checkbox" name="so" id="So" /> <label for="So">Sonntag
			30.09.2009</label><br>
			</td>
		</tr>
		<tr>

			<td width="200"><span style="display: block; padding-top: 7px;">Bereich</span></td>
			<td class="checkbox"><input type="checkbox" name="catering"
				id="id_catering" /> <label for="id_catering">Catering</label> <input
				type="checkbox" name="info_stand" id="id_info_stand" /> <label
				for="id_info_stand">Infostand</label> <input type="checkbox"
				name="bandbetreuung" id="id_bandbetreuung" /> <label
				for="id_bandbetreuung">Orchesterbetreuung</label> <br>
			<input type="checkbox" name="allrounder" id="id_allrounder" /> <label
				for="id_allrounder">AllrounderIn</label> <input type="checkbox"
				name="security" id="id_security" /> <label for="id_security">Security</label>
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input id="id_EMAILADDRESS" type="text" name="EMAILADDRESS"
				maxlength="75" /></td>
		</tr>

		<tr>
			<td>Vorname</td>
			<td><input id="id_FIRSTNAME" type="text" name="FIRSTNAME"
				maxlength="100" /></td>
		</tr>
		<tr>
			<td>Name</td>
			<td><input id="id_LASTNAME" type="text" name="LASTNAME"
				maxlength="100" /></td>
		</tr>

		<tr>
			<td>Telefon</td>
			<td><input id="id_OFFICEPHONE" type="text" name="OFFICEPHONE"
				maxlength="20" /> (optional)</td>
		</tr>
		<tr>
			<td>Bemerkungen
			
			
			<td><textarea id="id_NOTE" rows="5" cols="50" name="NOTE"></textarea></td>
		</tr>
		<tr>
			<td>Bild für Konzert-Ausweis hochladen. (max 1 MB)</td>
			<td><input type="file" name="toProcess"></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="EIGENSCHAFT" value="Helfer" /> <input
				type="submit" name="senden" value="Abschicken" /></td>
		</tr>

	</TBODY>
</TABLE>
</form>
