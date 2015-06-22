<?php
/**
 * Created by PhpStorm.
 * User: Khanh
 * Date: 17/6/2015
 * Time: 3:26 PM
 */
require_once (dirname(__FILE__) . "/KandyPage.php");
require_once (KANDY_PLUGIN_DIR . "/api/kandy-api-class.php");
require_once KANDY_PLUGIN_DIR . '/admin/AgentsTableList.php';

class LiveChatAssignmentPage extends KandyPage {

    public function render()
    {
        $this->render_page_start('List support agent');
        ?>
        <h3>
            <select class="select2" id="kandyUserListForAgents">
                <?php echo $this->getOptionsData()?>
            </select>
            <a href="javascript:;" id="kandyBtnAddAgent" class="button-primary"><?php _e("Add", "kandy"); ?></a></h3>
        <?php
        $agentTableList = new AgentsTableList();
        $agentTableList->prepare_items();
        $agentTableList->display();
        $this->render_page_end();
    }

    protected function getOptionsData() {
        $result = "<option value=''>None</option>";
        $users = KandyApi::getUsersForChatAgent();
        foreach($users as $u){
            $result .= "<option value ='" . $u->id."'>". $u->user_nicename . "</option>";
        }
        return $result;
    }

    public function remove_agent() {
        $userId = intval($_GET['id']);
        global $wpdb;
        if($userId) {
            //change type of user to normal
            $affectedRow = $wpdb->update(
                $wpdb->prefix . 'kandy_users',
                array(
                    'type' => KANDY_USER_TYPE_NORMAL,
                ),
                array('id' => $userId)
            );
        }
        KandyApi::redirect(admin_url('admin.php?page=kandy-live-chat'),'Remove agent successful');
    }

    public function user_for_live_chat()
    {
        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST['liveChatUsers'])){
                update_option('kandy_live_chat_users', json_encode($_POST['liveChatUsers']));
            }
        }
        $this->render_page_start("Users use for live chat");
        $excluded_users = get_option('kandy_excluded_users');
        $excluded_users = preg_split('/[\s,]+/',$excluded_users);
        $kandyLiveChatUsers = json_decode(get_option('kandy_live_chat_users', '[]'));
        ?>
        <h3>Select Kandy users to reserve for live chat</h3>
        <form method="post">
        <select class="select2" multiple name='liveChatUsers[]'>
        <?php
            foreach($excluded_users as $user) {
                ?>
                <option <?php echo (array_search($user,$kandyLiveChatUsers) !== false )?"selected":'' ?>><?php echo $user;?></option>
            <?php
            }
            ?>
        </select>
        <button class="button-primary" type="submit">Save changes</button>

        </form>
        <?php
        $this->render_page_end();
    }

    /**
     * View support processes of a specific agent
     */
    public function view_agent_process() {
        add_thickbox();
        require KANDY_PLUGIN_DIR . '/admin/AgentRatesList.php';
        global $wpdb;
        $agentId = intval($_GET['id']);
        $tableUser = $wpdb->prefix . 'users';
        $tableKandyUser = $wpdb->prefix . 'kandy_users';
        $agent = $wpdb->get_results(
            "SELECT user_nicename, $tableKandyUser.user_id AS kandy_user
            FROM $tableUser
            INNER JOIN $tableKandyUser
            ON $tableUser.ID = $tableKandyUser.main_user_id
            WHERE $tableUser.ID = $agentId LIMIT 1"
        );
        $this->render_page_start("Agent rates");
        ?>
        <h3><?php echo "{$agent[0]->user_nicename}'s rates"?></h3>
        <?php
        $agentRatesList = new AgentRatesList();
        $agentRatesList->prepare_items();
        $agentRatesList->display();
        $this->render_page_end();
    }

}