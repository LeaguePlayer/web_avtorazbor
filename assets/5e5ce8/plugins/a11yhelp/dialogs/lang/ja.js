﻿/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.plugins.setLang( 'a11yhelp', 'ja', {
	title: 'ユーザー補助の説明',
	contents: 'ヘルプ　このダイアログを閉じるには ESCを押してください。',
	legend: [
		{
		name: '全般',
		items: [
			{
			name: 'エディターツールバー',
			legend: 'Press ${toolbarFocus} to navigate to the toolbar. Move to the next and previous toolbar group with TAB and SHIFT-TAB. Move to the next and previous toolbar button with RIGHT ARROW or LEFT ARROW. Press SPACE or ENTER to activate the toolbar button.' // MISSING
		},

			{
			name: '編集ダイアログ',
			legend: 'Inside a dialog, press TAB to navigate to next dialog field, press SHIFT + TAB to move to previous field, press ENTER to submit dialog, press ESC to cancel dialog. For dialogs that have multiple tab pages, press ALT + F10 to navigate to tab-list. Then move to next tab with TAB OR RIGTH ARROW. Move to previous tab with SHIFT + TAB or LEFT ARROW. Press SPACE or ENTER to select the tab page.' // MISSING
		},

			{
			name: 'エディターのメニュー',
			legend: 'Press ${contextMenu} or APPLICATION KEY to open context-menu. Then move to next menu option with TAB or DOWN ARROW. Move to previous option with SHIFT+TAB or UP ARROW. Press SPACE or ENTER to select the menu option. Open sub-menu of current option with SPACE or ENTER or RIGHT ARROW. Go back to parent menu item with ESC or LEFT ARROW. Close context menu with ESC.' // MISSING
		},

			{
			name: 'エディターリストボックス',
			legend: 'Inside a list-box, move to next list item with TAB OR DOWN ARROW. Move to previous list item with SHIFT + TAB or UP ARROW. Press SPACE or ENTER to select the list option. Press ESC to close the list-box.' // MISSING
		},

			{
			name: 'エディター要素パスバー',
			legend: 'Press ${elementsPathFocus} to navigate to the elements path bar. Move to next element button with TAB or RIGHT ARROW. Move to previous button with  SHIFT+TAB or LEFT ARROW. Press SPACE or ENTER to select the element in editor.' // MISSING
		}
		]
	},
		{
		name: 'コマンド',
		items: [
			{
			name: '元に戻す',
			legend: '${undo} をクリック'
		},
			{
			name: 'やり直し',
			legend: '${redo} をクリック'
		},
			{
			name: '太字',
			legend: '${bold} をクリック'
		},
			{
			name: '斜体 ',
			legend: '${italic} をクリック'
		},
			{
			name: '下線',
			legend: '${underline} をクリック'
		},
			{
			name: 'リンク',
			legend: '${link} をクリック'
		},
			{
			name: 'ツールバーを縮める',
			legend: '${toolbarCollapse} をクリック'
		},
			{
			name: ' Access previous focus space command', // MISSING
			legend: 'Press ${accessPreviousSpace} to access the closest unreachable focus space before the caret, for example: two adjacent HR elements. Repeat the key combination to reach distant focus spaces.' // MISSING
		},
			{
			name: ' Access next focus space command', // MISSING
			legend: 'Press ${accessNextSpace} to access the closest unreachable focus space after the caret, for example: two adjacent HR elements. Repeat the key combination to reach distant focus spaces.' // MISSING
		},
			{
			name: 'ユーザー補助ヘルプ',
			legend: '${a11yHelp} をクリック'
		}
		]
	}
	]
});
