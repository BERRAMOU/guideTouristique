package com.guideapp.guideapp.ui.activities.local;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.Toolbar;
import android.widget.ImageView;

import com.guideapp.guideapp.R;
import com.guideapp.guideapp.model.SubCategory;
import com.guideapp.guideapp.ui.activities.BaseActivity;
import com.guideapp.guideapp.ui.fragments.FilterDialogFragment;

import java.util.List;

import butterknife.Bind;
import butterknife.ButterKnife;

/**
 * Local Activity
 */
public class LocalActivity extends BaseActivity
        implements LocalContract.ViewActivity, FilterDialogFragment.FilterDialogPositiveListener {
    @Bind(R.id.toolbar) Toolbar mToolbar;
    @Bind(R.id.button_filter) ImageView mButtonFilter;
    private LocalContract.UserActionsActivityListener mActionsListener;
    private long mIdCity;
    private long mIdCategory;
    private int mIdTitle;
    private int mIdTheme;
    private int mIdColorStatusBar;
    private long[] mIdSubCategories;

    private static final String EXTRA_CITY = "id-city";
    private static final String EXTRA_CATEGORY = "id-category";
    private static final String EXTRA_SUB_CATEGORY = "id-sub-category";
    private static final String EXTRA_ID_TITLE = "id-title";
    private static final String EXTRA_ID_THEME = "id-theme";
    private static final String EXTRA_ID_COLOR_STATUS_BAR = "id-color-status";

    /**
     * Navigate to local activity
     * @param context The Context the view is running in
     * @param idCity The city id
     * @param idCategory The category id
     * @param idTitle The title
     * @param idTheme The theme
     * @param idColorStatusBar The color status id
     */
    public static void navigate(Context context,
                                Long idCity,
                                Long idCategory,
                                int idTitle,
                                int idTheme,
                                int idColorStatusBar) {
        Intent intent = new Intent(context, LocalActivity.class);
        intent.putExtra(EXTRA_CITY, idCity);
        intent.putExtra(EXTRA_CATEGORY, idCategory);
        intent.putExtra(EXTRA_ID_TITLE, idTitle);
        intent.putExtra(EXTRA_ID_THEME, idTheme);
        intent.putExtra(EXTRA_ID_COLOR_STATUS_BAR, idColorStatusBar);

        context.startActivity(intent);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        initExtra();

        setContentView(R.layout.activity_local);
        ButterKnife.bind(this);

        initToolbar();
        setViewProperties();

        mActionsListener = new LocalActivityPresenter(this, this);

        initFragment(LocalFragment.newInstance(mIdCity, mIdCategory, mIdSubCategories));
    }

    /**
     * Initialize fragment
     * @param fragment Fragment
     */
    private void initFragment(Fragment fragment) {
        FragmentManager fragmentManager = getSupportFragmentManager();
        FragmentTransaction transaction = fragmentManager.beginTransaction();
        transaction.add(R.id.contentFrame, fragment);
        transaction.commit();
    }

    /**
     * Initialize extras parameters
     */
    private void initExtra() {
        mIdCity = getIntent().getLongExtra(EXTRA_CITY, 0);
        mIdCategory = getIntent().getLongExtra(EXTRA_CATEGORY, 0);
        mIdTitle = getIntent().getIntExtra(EXTRA_ID_TITLE, 0);
        mIdTheme = getIntent().getIntExtra(EXTRA_ID_THEME, 0);
        mIdColorStatusBar = getIntent().getIntExtra(EXTRA_ID_COLOR_STATUS_BAR, 0);

        setTheme(mIdTheme, mIdColorStatusBar);
    }

    /**
     * Initialize Toolbar
     */
    private void initToolbar() {
        setSupportActionBar(mToolbar);
        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
            getSupportActionBar().setTitle(mIdTitle);
        }
    }

    /**
     * Initialize view's listener
     */
    private void setViewProperties() {
        mButtonFilter.setOnClickListener(v -> mActionsListener.loadFilters(mIdCategory));
    }

    @Override
    public void showFilter(List<SubCategory> subCategories) {
        FilterDialogFragment newFragment =
                FilterDialogFragment.newInstance(subCategories, mIdSubCategories);
        newFragment.show(getFragmentManager(), "missiles", this);
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        mActionsListener.unsubscribe();
    }

    @Override
    public void onFilterDialogPositive(long[] idSubCategories) {
        mIdSubCategories = idSubCategories;

        initFragment(LocalFragment.newInstance(mIdCity, mIdCategory, mIdSubCategories));
    }
}
