<tr>
    <td>
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="hidden" name="invitation_id" value="{{$invitation->id}}">
    </td>
</tr>
<tr>
    <td colspan="2" class="text-left">
        <label class="text-left">{{$ceramony->name}}</label>
        <input type="hidden" name="ceramony_id[{{$loop->index}}]" value="0"></label>
        <input type="hidden" name="ceramony_id[{{$loop->index}}]" value="{{$ceramony->id}}">
    </td>

    <td colspan="2" class="text-right">
        <label class="form-label">
            <input type="radio" class="form-radio" name="invitationStatus[{{$loop->index}}]" value="0">No Invite</label>
        <label class="form-label">
            <input type="radio" class="form-radio" name="invitationStatus[{{$loop->index}}]" value="1">Single</label>
        <label class="form-label">
            <input type="radio" class="form-radio" name="invitationStatus[{{$loop->index}}]" value="2" checked>With Spouse</label>
        <label class="form-label">
            <input type="radio" class="form-radio" name="invitationStatus[{{$loop->index}}]" value="3">With Family</label>
    </td>
</tr>
